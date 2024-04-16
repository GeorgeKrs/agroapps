<?php

namespace App\Enums;

use Illuminate\Support\Str;
use Spatie\Enum\Laravel\Enum;

/**
 * @method static self success()
 * @method static self error()
 * @method static self warning()
 */
final class StatusTypeEnum extends Enum
{
    protected static function labels(): \Closure
    {
        return fn(string $name) => Str::headline(__($name));
    }
}
