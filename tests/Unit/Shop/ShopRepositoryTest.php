<?php

namespace Tests\Unit\Shop;

use App\Models\Shop;
use App\Models\ShopCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShopRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_update_on_repository()
    {
        // Arrange
        $user = User::factory()->create();
        ShopCategory::factory()->count(2)->create();

        $shop = Shop::factory()->state([
            "owner_id" => $user->id,
            "category_id" => ShopCategory::query()->first()->id,
        ])->create();

        // Act
        $shop->repository()->update([
            "category_id" => ShopCategory::query()->latest()->first()->id,
        ]);

        // Assert
        $this->assertEquals($shop->category_id, ShopCategory::query()->latest()->first()->id);
    }

    public function test_delete_on_repository()
    {
        // Arrange
        $user = User::factory()->create();
        $category = ShopCategory::factory()->create();

        $shop = Shop::factory()->state([
            "owner_id" => $user->id,
            "category_id" => $category->id,
        ])->create();

        // Act
        $result = $shop->repository()->delete();

        // Assert
        $this->assertTrue($result);
    }
}
