<?php

namespace App\Repositories;

use App\Models\User;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Support\Str;
use Laravel\Sanctum\NewAccessToken;

class UserRepository
{
    public function __construct(public User $user)
    {
    }

    public static function store(array $payload): User
    {
        return User::query()->create($payload);
    }

    public function generateToken(?DateTimeInterface $expiresAt = null): NewAccessToken
    {
        $this->user->tokens()->delete();

        return $this->user->createToken(
            name: Str::random(32),
            expiresAt: $expiresAt ?? Carbon::now()->addWeek()
        );
    }
}
