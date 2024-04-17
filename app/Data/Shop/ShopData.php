<?php

namespace App\Data\Shop;

use App\Data\ShopCategory\ShopCategoryData;
use App\Data\ShopOffer\ShopOfferData;
use App\Data\User\UserData;
use App\Models\Shop;
use Spatie\LaravelData\Data;

class ShopData extends Data
{
    public function __construct(
        public int              $id,
        public string           $name,
        public int              $ownerId,
        public int              $categoryId,
        public string           $description,
        public array            $openHours,
        public string           $city,
        public ?string          $address,

        public UserData         $owner,
        public ShopCategoryData $category,

        public mixed            $offers,
    )
    {
    }

    public static function fromModel(Shop $shop): static
    {
        return new self(
            id: $shop->id,
            name: $shop->name,
            ownerId: $shop->owner_id,
            categoryId: $shop->category_id,
            description: $shop->description,
            openHours: $shop->open_hours,
            city: $shop->city,
            address: $shop->address,
            owner: UserData::fromModel($shop->owner),
            category: ShopCategoryData::fromModel($shop->category),
            offers: ShopOfferData::collect($shop->offers),
        );
    }
}
