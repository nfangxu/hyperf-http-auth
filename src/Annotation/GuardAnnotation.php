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
use Fx\HyperfHttpAuth\Contract\Guard;
use Hyperf\Di\Annotation\AbstractAnnotation;

/**
 * Class UserProviderAnnotation.
 *
 * @Annotation
 * @Target("CLASS")
 */
class GuardAnnotation extends AbstractAnnotation
{
    /**
     * @var string
     */
    public $value;

    public function __construct($value = null)
    {
        parent::__construct($value);
    }

    public function collectClass(string $className): void
    {
        parent::collectClass($className);
        Config::setAnnotation($this->value, $className, Guard::class);
    }
}
