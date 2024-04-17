<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Support\Facades\Log;

class ShopPolicy
{
    public function viewAny(User $user): bool
    {
        Log::debug("viewAny");
        return true;
    }
}
