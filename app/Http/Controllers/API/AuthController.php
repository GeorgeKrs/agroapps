<?php

namespace App\Http\Controllers\API;

use App\Data\ApiResponseData;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Auth\LoginRequest;
use App\Http\Requests\API\Auth\RegisterRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function register(RegisterRequest $request): JsonResponse
    {
        try {
            $user = UserRepository::store($request->formatPayload());

            $token = $user->repository()->generateToken();

            return ApiResponseData::success(
                message: 'Registration Complete!',
                statusCode: 201,
                data: [
                    "token" => $token->plainTextToken,
                ]
            );

        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Log::error($exception->getLine());
            Log::error($exception->getTraceAsString());

            return ApiResponseData::error();
        }
    }

    public function login(LoginRequest $request): JsonResponse
    {
        try {
            if (Auth::attempt($request->safe()->toArray())) {
                $user = Auth::user();

                $token = $user->repository()->generateToken();

                return ApiResponseData::success(
                    message: 'Login successfully!',
                    statusCode: 201,
                    data: [
                        "token" => $token->plainTextToken,
                    ]
                );
            }
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Log::error($exception->getLine());
            Log::error($exception->getTraceAsString());
        }

        return ApiResponseData::error();
    }
}
