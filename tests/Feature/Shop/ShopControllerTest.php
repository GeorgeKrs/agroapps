<?php

namespace Tests\Feature\Shop;

use App\Enums\StatusTypeEnum;
use App\Models\Shop;
use App\Models\ShopCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShopControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_shop_index(): void
    {
        $user = User::factory()->create();
        ShopCategory::factory()->count(2)->create();

        Shop::factory()->state([
            "owner_id" => $user->id,
            "category_id" => ShopCategory::query()->first()->id,
        ])->create();

        Shop::factory()->state([
            "owner_id" => $user->id,
            "category_id" => ShopCategory::query()->latest()->first()->id,
        ])->create();

        $response = $this->get('api/guest/shops');

        $response->assertStatus(200)->assertJsonFragment([
            "message" => "Available Shops",
            "status" => StatusTypeEnum::success(),
            "statusCode" => 200,
        ]);
    }

    public function test_shop_delete(): void
    {
        $user = User::factory()->create();
        ShopCategory::factory()->count(2)->create();

        $shop = Shop::factory()->state([
            "owner_id" => $user->id,
            "category_id" => ShopCategory::query()->first()->id,
        ])->create();

        $loginResponse = $this->post("api/auth/login", [
            "email" => $user->email,
            "password" => "password"
        ]);

        $token = $loginResponse->baseResponse->getOriginalContent()->data["token"];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->delete("api/shops/$shop->id/delete");

        $response->assertStatus(200);
        $this->assertEquals(null, Shop::query()->find($shop->id));
    }
}
