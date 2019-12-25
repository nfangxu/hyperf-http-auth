<?php
declare(strict_types=1);

if (!function_exists('auth')) {
    /**
     * @param null $guard
     * @return \Fx\HyperfHttpAuth\Contract\HttpAuthContract
     */
    function auth($guard = null)
    {
        return make(\Fx\HyperfHttpAuth\Contract\HttpAuthContract::class, [$guard]);
    }
}