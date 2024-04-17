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
        public ?int            $statusCode,
        public mixed           $data,
    )
    {
    }

    public static function success(?string $message, ?int $statusCode = 200, mixed $data = []): JsonResponse
    {
        return response()->json(new self(
            message: $message,
            status: StatusTypeEnum::success(),
            statusCode: $statusCode,
            data: $data,
        ));
    }

    public static function error(?string $message = "Something went wrong! Please try again later.", mixed $data = [], ?int $statusCode = 500): JsonResponse
    {
        return response()->json(new self(
            message: $message,
            status: StatusTypeEnum::error(),
            statusCode: $statusCode,
            data: $data,
        ));
    }

    public static function warning(?string $message, ?int $statusCode = 200, mixed $data = []): JsonResponse
    {
        return response()->json(new self(
            message: $message,
            status: StatusTypeEnum::warning(),
            statusCode: $statusCode,
            data: $data,
        ));
    }

    public static function unauthorized(?string $message = "This action is unauthorized", ?int $statusCode = 403, mixed $data = []): JsonResponse
    {
        return response()->json(new self(
            message: $message,
            status: StatusTypeEnum::error(),
            statusCode: $statusCode,
            data: $data,
        ));
    }
}
