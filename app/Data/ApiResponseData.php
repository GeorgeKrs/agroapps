<?php

namespace App\Data;

use App\Enums\StatusTypeEnum;
use Illuminate\Http\JsonResponse;
use Spatie\LaravelData\Data;

class ApiResponseData extends Data
{
    public function __construct(
        public ?string         $message,
        public ?StatusTypeEnum $status,
        public mixed           $data,
    )
    {
    }

    public static function success(?string $message, mixed $data = []): JsonResponse
    {
        return response()->json(new self(
            message: $message,
            status: StatusTypeEnum::success(),
            data: $data
        ));
    }

    public static function error(?string $message = "Something went wrong! Please try again later.", mixed $data = []): JsonResponse
    {
        return response()->json(new self(
            message: $message,
            status: StatusTypeEnum::error(),
            data: $data
        ));
    }

    public static function warning(?string $message, mixed $data = []): JsonResponse
    {
        return response()->json(new self(
            message: $message,
            status: StatusTypeEnum::warning(),
            data: $data
        ));
    }
}
