<?php
declare(strict_types=1);

namespace Fx\HyperfHttpAuth;

use Fx\HyperfHttpAuth\Contract\Guard;
use Fx\HyperfHttpAuth\Contract\HttpAuthContract;
use Fx\HyperfHttpAuth\Contract\UserProvider;
use Fx\HyperfHttpAuth\Exception\InvalidArgumentException;

class HttpAuthManage implements HttpAuthContract
{
    use CreatesUserProviders, ContextHelpers;

    /**
     * @var \Closure
     */
    protected $userResolver;

    public function __construct()
    {
        // var_dump(Config::annotations());
    }

    /**
     * @param string|null $name
     * @return \Fx\HyperfHttpAuth\Contract\Guard
     */
    public function guard($name = null): Guard
    {
        $name = $name ?: $this->getDefaultDriver();

        $guard = $this->getContext('guards::' . $name);

        return $guard ?: $this->setContext('guards::' . $name, $this->resolve($name));
    }

    /**
     * @param string $name
     * @return void
     */
    public function shouldUse($name)
    {
        $name = $name ?: $this->getDefaultDriver();

        $this->setDefaultDriver($name);

        $this->userResolver = function ($name = null) {
            return $this->guard($name)->user();
        };
    }

    public function getDefaultDriver()
    {
        return Config::get('defaults.guard');
    }

    protected function resolve($name)
    {
        $config = $this->getConfig($name);

        if (is_null($config)) {
            throw new InvalidArgumentException("Auth guard [{$name}] is not defined.");
        }

        if ($class = Config::getAnnotation($config['driver'] ?? '', Guard::class)) {
            error_log("Use Guard: [{$class}]");
            return make($class, [$config, $this->createUserProvider($config['provider'] ?? null)]);
        } else {
            throw new InvalidArgumentException(
                "Auth driver [{$config['driver']}] for guard [{$name}] is not defined."
            );
        }
    }

    protected function getConfig($name)
    {
        return Config::get("guards.{$name}");
    }

    public function setDefaultDriver($name)
    {
        Config::set('defaults.guard', $name);
    }

    public function __call($method, $parameters)
    {
        return $this->guard()->{$method}(...$parameters);
    }
}