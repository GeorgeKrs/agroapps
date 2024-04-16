<?php

namespace Database\Factories;

use App\Models\Shop;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShopOfferFactory extends Factory
{
    public function definition(): array
    {
        return [
            "name" => fake()->name,
            "description" => fake()->sentence(2),
            "shop_id" => Shop::factory()->create(),
        ];
    }
}
