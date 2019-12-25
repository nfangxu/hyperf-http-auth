<?php
declare(strict_types=1);

namespace Fx\HyperfHttpAuth\Contract;

use \Fx\HyperfHttpAuth\Contract\Authenticatable;

interface Guard
{
    /**
     * Determine if the current user is authenticated.
     *
     * @return bool
     */
    public function check();

    /**
     * Determine if the current user is a guest.
     *
     * @return bool
     */
    public function guest();

    /**
     * Get the currently authenticated user.
     *
     * @return \Fx\HyperfHttpAuth\Contract\Authenticatable|null
     */
    public function user();

    /**
     * Get the ID for the currently authenticated user.
     *
     * @return int|string|null
     */
    public function id();

    /**
     * Get the name for the currently authenticated user.
     *
     * @return string|null
     */
    public function name();

    /**
     * Validate a user's credentials.
     *
     * @param array $credentials
     * @return bool
     */
    public function validate(array $credentials = []);

    /**
     * Set the current user.
     *
     * @param \Fx\HyperfHttpAuth\Contract\Authenticatable $user
     * @return void
     */
    public function setUser(Authenticatable $user);
}
