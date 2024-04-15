<?php

namespace App\Enums;

use Spatie\Enum\Laravel\Enum;

/**
 * @typescript
 * @method static self production()
 * @method static self staging()
 * @method static self local()
 */
final class AppEnvironmentEnum extends Enum
{
}
