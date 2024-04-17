<?php

namespace Tests\Unit\Shop;

use App\Models\Shop;
use App\Models\ShopCategory;
use App\Models\ShopOffer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShopTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_belongs_to_user()
    {
        // Arrange
        $user = User::factory()->create();
        $category = ShopCategory::factory()->create();

        $shop = Shop::factory()->state([
            "owner_id" => $user->id,
            "category_id" => $category->id,
        ])->create();

        // Act
        $owner = $shop->owner;

        // Assert
        $this->assertInstanceOf(User::class, $owner);
        $this->assertEquals($user->id, $shop->owner_id);
    }

    public function test_it_belongs_to_category()
    {
        // Arrange
        $user = User::factory()->create();
        $category = ShopCategory::factory()->create();

        $shop = Shop::factory()->state([
            "owner_id" => $user->id,
            "category_id" => $category->id,
        ])->create();

        // Act
        $category = $shop->category;

        // Assert
        $this->assertInstanceOf(ShopCategory::class, $category);
        $this->assertEquals($shop->category_id, $category->id);
    }

    public function test_it_has_many_shop_offers()
    {
        // Arrange
        $user = User::factory()->create();
        $category = ShopCategory::factory()->create();

        $shop = Shop::factory()->state([
            "owner_id" => $user->id,
            "category_id" => $category->id,
        ])->create();

        $shopOffers = collect();
        $offersToCreate = rand(1, 5);

        for ($shopNumber = 1; $shopNumber <= $offersToCreate; $shopNumber++) {
            $shopOffers->push(
                ShopOffer::factory()->state([
                    "shop_id" => $shop->id,
                ])->create());
        }

        // Act

        // Assert
        $this->assertEquals($shop->offers->count(), $shopOffers->count());
    }

    public function test_owners_filter()
    {
        // Arrange
        $users = collect([
            User::factory()->create(),
            User::factory()->create(),
            User::factory()->create(),
        ]);

        $category = ShopCategory::factory()->create();

        foreach ($users as $user) {
            Shop::factory()->state([
                "owner_id" => $user->id,
                "category_id" => $category->id,
            ])->create();
        }

        // Act
        $owner = User::query()->first();

        // Assert
        $shops = Shop::query()->filter(ownerIds: [$owner->id])->get();

        $this->assertEquals(1, $shops->pluck("owner_id")->unique()->count());
    }
}
