<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ShopCategoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => "Category " . fake()->randomNumber(),
        ];
    }
}
