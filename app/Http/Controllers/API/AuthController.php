<?php

namespace App\Http\Controllers\API;

use App\Data\ApiResponseData;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Auth\LoginRequest;
use App\Http\Requests\API\Auth\RegisterRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(RegisterRequest $request): JsonResponse
    {
        $user = UserRepository::store($request->formatPayload());

        $token = $user->repository()->generateToken();

        return ApiResponseData::success(
            message: 'Registration Complete!',
            data: [
                "token" => $token->plainTextToken,
                "status" => 201
            ]
        );
    }

    public function login(LoginRequest $request): JsonResponse
    {
        if (Auth::attempt($request->safe()->toArray())) {
            $user = Auth::user();

            $token = $user->repository()->generateToken();

            return ApiResponseData::success(
                message: 'Login successfully!',
                data: [
                    "token" => $token->plainTextToken,
                    "status" => 201,
                ]
            );
        }

        return ApiResponseData::error("Unauthorized", [
            "status" => 401,
        ]);
    }
}
