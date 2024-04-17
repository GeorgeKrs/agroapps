<?php

namespace App\Policies;

use App\Models\Shop;
use App\Models\User;

class ShopOfferPolicy
{
    public function store(User $user, Shop $shop): bool
    {
        if ($user->id === $shop->owner_id) {
            return true;
        }

        return false;
    }
}
