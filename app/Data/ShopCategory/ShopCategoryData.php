<?php

namespace App\Data\ShopCategory;

use Spatie\LaravelData\Data;

class ShopCategoryData extends Data
{
    public function __construct(
        public int     $id,
        public string  $name,
    )
    {
    }
}
