<?php

namespace App\Repositories;

use App\Models\Shop;

class ShopRepository
{
    public function __construct(public Shop $shop)
    {
    }

    public static function store(array $payload): Shop
    {
        return Shop::query()->create($payload);
    }

    public function update(array $payload): bool
    {
        return $this->shop->update($payload);
    }

    public function delete(): ?bool
    {
        return $this->shop->delete();
    }
}
