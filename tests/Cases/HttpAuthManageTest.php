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

use Fx\HyperfHttpAuth\Config;
use Fx\HyperfHttpAuth\Contract\Guard;
use Fx\HyperfHttpAuth\Contract\UserProvider;
use Fx\HyperfHttpAuth\HttpAuthManage;

/**
 * @internal
 * @coversNothing
 */
class HttpAuthManageTest extends AbstractTestCase
{
    public function testSetAnnotation()
    {
        $this->setAnnotations();

        $this->assertEquals(TestGuard::class, Config::getAnnotation('test', Guard::class));
        $this->assertEquals(TestUserProvider::class, Config::getAnnotation('test', UserProvider::class));
    }

    public function testGuard()
    {
        $guard = $this->auth()->guard();

        $this->assertEquals(true, $guard instanceof TestGuard);
        $this->assertEquals(true, $guard->provider instanceof TestUserProvider);
    }

    protected function setAnnotations()
    {
        Config::setAnnotation('test', TestGuard::class, Guard::class);
        Config::setAnnotation('test', TestUserProvider::class, UserProvider::class);
    }

    protected function config()
    {
        return new \Hyperf\Config\Config([
            'http-auth' => [
                'defaults' => [
                    'guard' => 'web',
                ],

                'guards' => [
                    'web' => [
                        'driver' => 'test', // guard provider name
                        'provider' => 'test-user-provider',
                    ],
                ],

                'providers' => [
                    'test-user-provider' => [
                        'driver' => 'test', // user provider name
                        // ... others config
                    ],
                ],
            ],
        ]);
    }

    protected function auth()
    {
        return new HttpAuthManage($this->config());
    }
}
