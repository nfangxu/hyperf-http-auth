<?php
declare(strict_types=1);

namespace Fx\HyperfHttpAuth;

use Hyperf\Utils\Context;
use Hyperf\Di\Annotation\AnnotationCollector;

/**
 * Class Config
 * @package Fx\HyperfHttpAuth
 */
class Config
{
    /**
     * @var array
     */
    protected static $annotations = [];

    /**
     * @param $key
     * @param null $default
     * @param bool $isThisPackage
     * @return mixed|null
     */
    public static function get($key, $default = null, $isThisPackage = true)
    {
        $key = self::key($key, $isThisPackage);

        return Context::get($key, config($key, $default));
    }

    /**
     * @param $key
     * @param $value
     * @param bool $isThisPackage
     * @return void
     */
    public static function set($key, $value, $isThisPackage = true)
    {
        Context::set(self::key($key, $isThisPackage), $value);
    }

    /**
     * @param $key
     * @param $isThisPackage
     * @return string
     */
    protected static function key($key, $isThisPackage)
    {
        $prefix = $isThisPackage ? 'http-auth.' : '';

        $key = $prefix . $key;

        return $key;
    }

    /**
     * @param string $name
     * @param string $value
     * @param string $abstract
     * @return void
     */
    public static function setAnnotation($name, $value, $abstract)
    {
        self::$annotations[$abstract][$name] = $value;
    }

    /**
     * @param $name
     * @param $abstract
     * @return mixed|null
     */
    public static function getAnnotation($name, $abstract)
    {
        return self::$annotations[$abstract][$name] ?? null;
    }

    /**
     * @return array
     */
    public static function annotations()
    {
        return self::$annotations;
    }
}