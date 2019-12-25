<?php
declare(strict_types=1);

namespace Fx\HyperfHttpAuth;

use Hyperf\Utils\Context;
use Hyperf\Di\Annotation\AnnotationCollector;

class Config
{
    /**
     * @var array
     */
    protected static $annotations = [];

    public static function get($key, $default = null, $isThisPackage = true)
    {
        $key = self::key($key, $isThisPackage);

        return Context::get($key, config($key, $default));
    }

    public static function set($key, $value, $isThisPackage = true)
    {
        Context::set(self::key($key, $isThisPackage), $value);
    }

    protected static function key($key, $isThisPackage)
    {
        $prefix = $isThisPackage ? 'http-auth.' : '';

        $key = $prefix . $key;

        return $key;
    }

    public static function setAnnotation($name, $value, $abstract)
    {
        self::$annotations[$abstract][$name] = $value;
    }

    public static function getAnnotation($name, $abstract)
    {
        return self::$annotations[$abstract][$name] ?? null;
    }

    public static function annotations()
    {
        return self::$annotations;
    }
}