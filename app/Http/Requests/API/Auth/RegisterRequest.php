<?php

namespace App\Http\Requests\API\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "name" => 'required|string',
            "email" => 'required|string|email|unique:users',
            "password" => 'required|string|min:8',
        ];
    }

    public function messages(): array
    {
        return [
            "name.required" => "Name is required",
            "name.string" => "Name must be of type string",
            "email.required" => "Email is required",
            "email.string" => "String is required",
            "email.email" => "Not valid email",
            "email.unique" => "Email already in use",
            "password.required" => "Password is required",
            "password.string" => "Password must be of type string",
            "password.min" => "Password must be at least 8 characters",
        ];
    }

    public function formatPayload(): array
    {
        $payload = $this->safe()->toArray();
        $payload["password"] = Hash::make($this->password);

        return $payload;
    }
}


