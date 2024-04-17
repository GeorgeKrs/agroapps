<?php

namespace App\Data\ShopOffer;

use App\Models\ShopOffer;
use Spatie\LaravelData\Data;

class ShopOfferData extends Data
{
    public function __construct(
        public int    $id,
        public string $name,
        public string $description,
    )
    {
    }

    public static function fromModel(ShopOffer $shopOffer): static
    {
        return new self(
            id: $shopOffer->id,
            name: $shopOffer->name,
            description: $shopOffer->description,
        );
    }
}
