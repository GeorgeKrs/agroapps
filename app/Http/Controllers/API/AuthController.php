<?php

namespace App\Http\Controllers\API;

use App\Data\ApiResponseData;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Auth\LoginRequest;
use App\Http\Requests\API\Auth\RegisterRequest;
use App\Repositories\UserRepository;
use App\Traits\Exceptionable;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use Exceptionable;

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

        } catch (Exception $exception) {
            $this->handleErrorException($exception);
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
        } catch (Exception $exception) {
            $this->handleErrorException($exception);
        }

        return ApiResponseData::error();
    }
}
