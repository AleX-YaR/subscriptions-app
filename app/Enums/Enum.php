<?php

namespace App\Enums;

use ReflectionClass;

/**
 * Class Enum
 * @package App\Enums
 */
abstract class Enum
{
    /**
     * @return array
     */
    public static function values(): array
    {
        return array_values((new ReflectionClass(static::class))->getConstants());
    }
}
