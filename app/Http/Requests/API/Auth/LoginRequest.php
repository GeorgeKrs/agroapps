<?php

namespace App\Http\Requests\API\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "email" => 'required|string|email',
            "password" => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            "email.required" => "Email is required",
            "email.string" => "String is required",
            "email.email" => "Not valid email",
            "password.required" => "Password is required",
            "password.string" => "Password must be of type string",
        ];
    }
}


