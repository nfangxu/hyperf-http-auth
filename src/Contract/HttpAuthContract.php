<?php
declare(strict_types=1);

namespace Fx\HyperfHttpAuth\Contract;

/**
 * Interface HttpAuthContract
 * @package Fx\HyperfHttpAuth\Contract
 *
 * @method bool check()
 * @method bool guest()
 *
 * @see \Fx\HyperfHttpAuth\Contract\Guard
 * @method \Fx\HyperfHttpAuth\Contract\Authenticatable|null user()
 * @method int|string|null id()
 * @method string|null name()
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
     * @param string|null $name
     * @return \Fx\HyperfHttpAuth\Contract\Guard
     */
    public function guard($name = null): Guard;

    /**
     * @param string $name
     * @return void
     */
    public function shouldUse($name);
}