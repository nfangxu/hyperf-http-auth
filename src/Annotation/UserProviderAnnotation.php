<?php
declare(strict_types=1);

namespace Fx\HyperfHttpAuth\Annotation;

use Fx\HyperfHttpAuth\Config;
use Fx\HyperfHttpAuth\Contract\UserProvider;
use Hyperf\Di\Annotation\AbstractAnnotation;
use Hyperf\Di\Annotation\Inject;

/**
 * Class UserProviderAnnotation
 * @package Fx\HyperfHttpAuth\Annotation
 *
 * @Annotation
 * @Target("CLASS")
 */
class UserProviderAnnotation extends AbstractAnnotation
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
        Config::setAnnotation($this->value, $className, UserProvider::class);
    }
}