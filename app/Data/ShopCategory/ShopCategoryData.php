<?php

namespace App\Data\ShopCategory;

use App\Models\ShopCategory;
use Spatie\LaravelData\Data;

class ShopCategoryData extends Data
{
    public function __construct(
        public int    $id,
        public string $name,
    )
    {
    }

    public static function fromModel(ShopCategory $shopCategory): static
    {
        return new self(
            id: $shopCategory->id,
            name: $shopCategory->name,
        );
    }
}
