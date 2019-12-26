<?php
declare(strict_types=1);

namespace Fx\HyperfHttpAuth;

use Fx\HyperfHttpAuth\Exception\AuthenticationException;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
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
     * @param ContainerInterface $container
     * @param HttpAuthContract $auth
     */
    public function __construct(ContainerInterface $container, HttpAuthContract $auth)
    {
        $this->container = $container;
        $this->auth = $auth;
    }

    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $this->authenticate($request, $this->guards());

        return $handler->handle($request);
    }

    /**
     * @param ServerRequestInterface $request
     * @param array $guards
     */
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

    /**
     * @return array
     */
    protected function guards(): array
    {
        return [];
    }
}
