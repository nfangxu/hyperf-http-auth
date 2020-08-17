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

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => [
                \Fx\HyperfHttpAuth\Contract\HttpAuthContract::class => \Fx\HyperfHttpAuth\HttpAuthManage::class,
            ],
            'commands' => [
            ],
            'annotations' => [
                'scan' => [
                    'paths' => [
                        __DIR__,
                    ],
                    'collectors' => [
                        Config::class,
                    ],
                ],
            ],
            'publish' => [
                [
                    'id' => 'config',
                    'description' => 'The config for http-auth component.',
                    'source' => __DIR__ . '/../publish/http-auth.php',
                    'destination' => BASE_PATH . '/config/autoload/http-auth.php',
                ],
            ],
        ];
    }
}
