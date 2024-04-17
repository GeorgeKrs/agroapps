<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;

trait Exceptionable
{
    public function handleErrorException(mixed $exception): void
    {
        Log::error($exception->getMessage());
        Log::error($exception->getLine());
        Log::error($exception->getTraceAsString());
    }
}
