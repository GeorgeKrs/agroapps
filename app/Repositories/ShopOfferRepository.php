<?php

namespace App\Repositories;

use App\Models\ShopOffer;

class ShopOfferRepository
{
    public function __construct(public ShopOffer $shopOffer)
    {
    }

    public static function store(array $payload): ShopOffer
    {
        return ShopOffer::query()->create($payload);
    }
}
