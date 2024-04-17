<?php

namespace App\Data\Shop;

use App\Data\ShopCategory\ShopCategoryData;
use App\Data\ShopOffer\ShopOfferData;
use App\Data\User\UserData;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Lazy;

class ShopData extends Data
{
    public function __construct(
        public int                   $id,
        public string                $name,
        public int                   $ownerId,
        public int                   $categoryId,
        public string                $description,
        public array                 $openHours,
        public string                $city,
        public ?string               $address,

        public Lazy|UserData         $owner,
        public Lazy|ShopCategoryData $category,
        public Lazy|ShopOfferData    $offers,
    )
    {
    }
}
