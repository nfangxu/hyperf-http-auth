<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace HyperfTest\Cases;

use Fx\HyperfHttpAuth\Annotation\GuardAnnotation;
use Fx\HyperfHttpAuth\Contract\Authenticatable;
use Fx\HyperfHttpAuth\Contract\StatefulGuard;
use Fx\HyperfHttpAuth\Contract\UserProvider;

/**
 * Class TestGuard.
 *
 * @GuardAnnotation("test")
 */
class TestGuard implements StatefulGuard
{
    public $config;

    public $provider;

    public function __construct($config, UserProvider $provider)
    {
        $this->config = $config;
        $this->provider = $provider;
    }

    public function attempt(array $credentials = [], $remember = false)
    {
        return true;
    }

    public function once(array $credentials = [])
    {
        return true;
    }

    public function login(Authenticatable $user, $remember = false)
    {
    }

    public function loginUsingId($id, $remember = false)
    {
    }

    public function onceUsingId($id)
    {
        return true;
    }

    public function viaRemember()
    {
        return true;
    }

    public function logout()
    {
    }

    public function check()
    {
        return true;
    }

    public function guest()
    {
        return true;
    }

    public function user()
    {
        return null;
    }

    public function id()
    {
        return null;
    }

    public function name()
    {
        return null;
    }

    public function validate(array $credentials = [])
    {
        return true;
    }

    public function setUser(Authenticatable $user)
    {
    }
}
