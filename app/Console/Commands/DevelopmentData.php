<?php

namespace App\Console\Commands;

use App\Enums\AppEnvironmentEnum;
use App\Models\ShopCategory;
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

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        if ($this->shouldTerminateCommand()) {
            return CommandAlias::FAILURE;
        }

//        $this->createShopCategories();
//        $this->createUsers();
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

        $this->renderSuccess("Creating users", "[ OK ]");
    }

    private function createShopCategories(): void
    {
        $this->renderInfo("Creating shop categories", "[ IN PROGRESS ]");

        ShopCategory::factory()->count(20)->create();

        $this->renderSuccess("Creating shop categories", "[ OK ]");
    }
}
