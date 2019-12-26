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

        $this->resolveUsersUsing(function ($name = null) {
            return $this->guard($name)->user();
        });
    }

    protected function resolve($name)
    {
        $config = config("http-auth.guards.{$name}");

        if (is_null($config)) {
            throw new InvalidArgumentException("Auth guard [{$name}] is not defined.");
        }

        if ($class = Config::getAnnotation($config['driver'] ?? '', Guard::class)) {
            // error_log("Use Guard: [{$class}]");
            return make($class, [$config, $this->createUserProvider($config['provider'] ?? null)]);
        } else {
            throw new InvalidArgumentException(
                "Auth driver [{$config['driver']}] for guard [{$name}] is not defined."
            );
        }
    }

    /**
     * Get the user resolver callback.
     *
     * @return \Closure
     */
    public function userResolver()
    {
        return $this->getContext('userResolver');
    }

    /**
     * Set the callback to be used to resolve users.
     *
     * @param \Closure $userResolver
     * @return $this
     */
    public function resolveUsersUsing(\Closure $userResolver)
    {
        $this->setContext('userResolver', $userResolver);

        return $this;
    }

    public function setDefaultDriver($name)
    {
        $this->setContext('defaults.guard', $name);
    }

    public function getDefaultDriver()
    {
        return $this->getContext('defaults.guard') ?: config('http-auth.defaults.guard');
    }

    public function __call($method, $parameters)
    {
        return $this->guard()->{$method}(...$parameters);
    }
}