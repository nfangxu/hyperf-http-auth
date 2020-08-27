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

use Fx\HyperfHttpAuth\Annotation\GuardAnnotation;
use Fx\HyperfHttpAuth\Annotation\UserProviderAnnotation;
use Fx\HyperfHttpAuth\Contract\AuthAnnotation;
use Hyperf\Di\Annotation\AnnotationCollector;

/**
 * Class Config.
 */
class Config
{
    /**
     * @var array
     */
    protected static $annotations = [];

    /**
     * @param string $name
     * @param string $value
     * @param string $abstract
     */
    public static function setAnnotation($name, $value, $abstract)
    {
        self::$annotations[$abstract][$name] = $value;
    }

    /**
     * @param $name
     * @param $abstract
     * @return string
     */
    public static function getAnnotation($name, $abstract)
    {
        if (! self::$annotations) {
            self::annotations();
        }

        return self::$annotations[$abstract][$name] ?? '';
    }

    /**
     * @return array
     */
    public static function annotations()
    {
        $classes = AnnotationCollector::getClassesByAnnotation(GuardAnnotation::class)
            + AnnotationCollector::getClassesByAnnotation(UserProviderAnnotation::class);

        foreach ($classes as $value => $class) {
            /** @var AuthAnnotation $class */
            self::setAnnotation($class->getName(), $value, $class->getAbstractClass());
        }

        return self::$annotations;
    }
}
