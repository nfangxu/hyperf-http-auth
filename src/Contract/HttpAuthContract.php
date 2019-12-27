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

namespace Fx\HyperfHttpAuth\Contract;

/**
 * Interface HttpAuthContract.
 *
 * @method bool check()
 * @method bool guest()
 *
 * @see \Fx\HyperfHttpAuth\Contract\Guard
 * @method null|\Fx\HyperfHttpAuth\Contract\Authenticatable user()
 * @method null|int|string id()
 * @method null|string name()
 * @method bool validate(array $credentials = [])
 * @method setUser(\Fx\HyperfHttpAuth\Contract\Authenticatable $user)
 *
 * @see \Fx\HyperfHttpAuth\Contract\StatefulGuard
 * @method bool attempt(array $credentials = [], $remember = false)
 * @method bool once(array $credentials = [])
 * @method login(Authenticatable $user, $remember = false)
 * @method \Fx\HyperfHttpAuth\Contract\Authenticatable loginUsingId($id, $remember = false)
 * @method bool onceUsingId($id)
 * @method viaRemember()
 * @method logout()
 */
interface HttpAuthContract
{
    /**
     * @param null|string $name
     * @return \Fx\HyperfHttpAuth\Contract\Guard
     */
    public function guard($name = null): Guard;

    /**
     * @param string $name
     */
    public function shouldUse($name);
}
