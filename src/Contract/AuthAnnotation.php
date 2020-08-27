<?php
declare(strict_types=1);

namespace Fx\HyperfHttpAuth\Contract;

interface AuthAnnotation
{
    public function getAbstractClass(): string;

    public function getName(): string;
}
