<?php

namespace App\Data\User;

use App\Models\User;
use Spatie\LaravelData\Data;

class UserData extends Data
{
    public function __construct(
        public int    $id,
        public string $name,
        public string $email,
    )
    {
    }

    public static function fromModel(User $user): static
    {
        return new self(
            id: $user->id,
            name: $user->name,
            email: $user->email,
        );
    }
}
