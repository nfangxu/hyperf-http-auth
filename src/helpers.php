<?php
declare(strict_types=1);

use Hyperf\Utils\ApplicationContext;
use Fx\HyperfHttpAuth\Contract\HttpAuthContract;

if (!function_exists('auth')) {
    /**
     * @param null $guard
     * @return \Fx\HyperfHttpAuth\Contract\HttpAuthContract
     */
    function auth($guard = null)
    {
        $auth = ApplicationContext::getContainer()->get(HttpAuthContract::class);

        if (is_null($guard)) {
            return $auth;
        }

        return $auth->guard($guard);
    }
}