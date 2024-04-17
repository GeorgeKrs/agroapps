<?php

namespace App\Data\ShopOffer;

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
}
