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

namespace Fx\HyperfHttpAuth\Annotation;

use Fx\HyperfHttpAuth\Config;
use Fx\HyperfHttpAuth\Contract\AuthAnnotation;
use Fx\HyperfHttpAuth\Contract\UserProvider;
use Hyperf\Di\Annotation\AbstractAnnotation;

/**
 * Class UserProviderAnnotation.
 *
 * @Annotation
 * @Target("CLASS")
 */
class UserProviderAnnotation extends AbstractAnnotation implements AuthAnnotation
{
    /**
     * @var string
     */
    public $value;

    public function getAbstractClass(): string
    {
        return UserProvider::class;
    }

    public function getName(): string
    {
        return $this->value;
    }
}
