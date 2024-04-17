<?php

namespace App\Console\Commands;

use App\Enums\AppEnvironmentEnum;
use App\Models\Shop;
use App\Models\ShopCategory;
use App\Models\ShopOffer;
use App\Models\User;
use App\Traits\Renderable;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Symfony\Component\Console\Command\Command as CommandAlias;

class DevelopmentData extends Command
{
    use Renderable;

    protected $signature = 'app:development-data';
    protected $description = 'Generates development data';

    public function handle(): int
    {
        $this->renderInfo("Command for generating dataset", "[ IN PROGRESS ]");
        $this->renderLineBreaker();

        if ($this->shouldTerminateCommand()) {
            return CommandAlias::FAILURE;
        }

        $this->createUsers();
        $this->createShopCategories();
        $this->createShops();
        $this->createShopOffers();

        $this->renderInfo("Command for generating dataset", "[ OK ]");
        return CommandAlias::SUCCESS;
    }

    private function shouldTerminateCommand(): bool
    {
        if (App::environment() === AppEnvironmentEnum::production()->value) {
            $this->renderWarning("Can not generate development data in production env.");
            $this->renderError("Terminating command", "[ FAILURE ]");
            return true;
        }

        return false;
    }

    private function createUsers(): void
    {
        $this->renderInfo("Creating users", "[ IN PROGRESS ]");

        User::factory()->count(10)->create();

        $this->renderWarning("All users have password", "password");
        sleep(2);

        $this->renderSuccess("Creating users", "[ OK ]");
        $this->renderLineBreaker();
    }

    private function createShopCategories(): void
    {
        $this->renderInfo("Creating shop categories", "[ IN PROGRESS ]");

        ShopCategory::factory()->count(20)->create();

        $this->renderSuccess("Creating shop categories", "[ OK ]");
        $this->renderLineBreaker();
    }

    private function createShops(): void
    {
        $this->renderInfo("Creating shops", "[ IN PROGRESS ]");

        foreach (User::all() as $user) {
            for ($shopNumber = 1; $shopNumber <= rand(1, 5); $shopNumber++) {
                Shop::factory()
                    ->state([
                        "owner_id" => $user->id,
                        "category_id" => ShopCategory::query()->inRandomOrder()->first()->id,
                    ])
                    ->create();
            }
        }

        $this->renderSuccess("Creating shops", "[ OK ]");
        $this->renderLineBreaker();
    }

    private function createShopOffers(): void
    {
        $this->renderInfo("Creating shop offers", "[ IN PROGRESS ]");

        for ($shopNumber = 1; $shopNumber <= rand(10, 20); $shopNumber++) {
            ShopOffer::factory()
                ->state([
                    "shop_id" => Shop::query()->inRandomOrder()->first()->id,
                ])
                ->create();
        }

        $this->renderSuccess("Creating shop offers", "[ OK ]");
        $this->renderLineBreaker();
    }
}
