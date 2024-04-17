<?php

namespace App\Policies;

use App\Models\Shop;
use App\Models\User;

class ShopPolicy
{
    public function store(User $user): bool
    {
        return true;
    }

    public function update(User $user, Shop $shop): bool
    {
        return $user->id === $shop->owner_id;
    }

    public function delete(User $user, Shop $shop): bool
    {
        return $user->id === $shop->owner_id;
    }
}
