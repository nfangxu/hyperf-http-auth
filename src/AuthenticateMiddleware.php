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

namespace Fx\HyperfHttpAuth;

use Fx\HyperfHttpAuth\Exception\AuthenticationException;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AuthenticateMiddleware implements MiddlewareInterface
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var \Fx\HyperfHttpAuth\Contract\HttpAuthContract
     */
    protected $auth;

    /**
     * AuthenticateMiddleware constructor.
     *
     * @param ContainerInterface $container
     * @param Contract\HttpAuthContract $auth
     */
    public function __construct(ContainerInterface $container, Contract\HttpAuthContract $auth)
    {
        $this->container = $container;
        $this->auth = $auth;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $this->authenticate($request, $this->guards());

        return $handler->handle($request);
    }

    protected function authenticate(ServerRequestInterface $request, array $guards)
    {
        if (empty($guards)) {
            $guards = [null];
        }

        foreach ($guards as $guard) {
            if ($this->auth->guard($guard)->check()) {
                return $this->auth->shouldUse($guard);
            }
        }

        throw new AuthenticationException('Unauthenticated.', $guards);
    }

    protected function guards(): array
    {
        return [];
    }
}
