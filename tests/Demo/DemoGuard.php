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

namespace HyperfTest\Demo;

use Fx\HyperfHttpAuth\Annotation\GuardAnnotation;
use Fx\HyperfHttpAuth\Contract\Authenticatable;
use Fx\HyperfHttpAuth\Contract\StatefulGuard;
use Fx\HyperfHttpAuth\Contract\UserProvider;
use Fx\HyperfHttpAuth\GuardHelpers;

/**
 * Class TestGuard.
 *
 * @GuardAnnotation("test")
 */
class DemoGuard implements StatefulGuard
{
    use GuardHelpers;

    public $config;

    public function __construct($config, UserProvider $provider)
    {
        $this->config = $config;
        $this->setProvider($provider);
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

    public function validate(array $credentials = [])
    {
        return true;
    }

    public function user()
    {
        return $this->user;
    }
}
