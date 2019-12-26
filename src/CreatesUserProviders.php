<?php
declare(strict_types=1);

namespace Fx\HyperfHttpAuth;

use Fx\HyperfHttpAuth\Contract\UserProvider;
use Fx\HyperfHttpAuth\Exception\InvalidArgumentException;

trait CreatesUserProviders
{
    /**
     * Create the user provider implementation for the driver.
     *
     * @param string|null $provider
     * @return UserProvider|null
     *
     * @throws \InvalidArgumentException
     */
    public function createUserProvider($provider = null)
    {
        if (is_null($config = $this->getProviderConfiguration($provider))) {
            return;
        }

        $driver = ($config['driver'] ?? null);

        if ($class = Config::getAnnotation($driver, UserProvider::class)) {
            // error_log("Use User Provider: [{$class}]");
            return make($class, [$config]);
        } else {
            throw new InvalidArgumentException(
                "Authentication user provider [{$driver}] is not defined."
            );
        }
    }

    /**
     * Get the user provider configuration.
     *
     * @param string|null $provider
     * @return array|null
     */
    protected function getProviderConfiguration($provider)
    {
        if ($provider = $provider ?: $this->getDefaultUserProvider()) {
            return Config::get('providers.' . $provider);
        }
    }

    /**
     * Get the default user provider name.
     *
     * @return string
     */
    public function getDefaultUserProvider()
    {
        return Config::get('defaults.provider');
    }
}
