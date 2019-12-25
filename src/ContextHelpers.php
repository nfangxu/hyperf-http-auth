<?php
declare(strict_types=1);

namespace Fx\HyperfHttpAuth;

use Hyperf\Utils\Context;

trait ContextHelpers
{
    public function setContext($id, $value)
    {
        $id = static::class . '::' . $id;
        Context::set($id, $value);
        return $value;
    }

    public function getContext($id, $default = null, $coroutineId = null)
    {
        $id = static::class . '::' . $id;
        return Context::get($id, $default, $coroutineId);
    }
}