<?php
declare(strict_types=1);

namespace Fx\HyperfHttpAuth\Exception;


use Hyperf\Server\Exception\ServerException;

class AuthenticationException extends ServerException
{
    /**
     * All of the guards that were checked.
     *
     * @var array
     */
    protected $guards;

    /**
     * Create a new authentication exception.
     *
     * @param string $message
     * @param array $guards
     * @param string|null $redirectTo
     * @return void
     */
    public function __construct($message = 'Unauthenticated.', array $guards = [])
    {
        parent::__construct($message);

        $this->guards = $guards;
    }
}