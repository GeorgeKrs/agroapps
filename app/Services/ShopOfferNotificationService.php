<?php

namespace App\Services;

use App\Jobs\ShopOfferNotificationJob;
use App\Models\ShopOffer;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class ShopOfferNotificationService
{
    public function __construct(public ShopOffer $shopOffer)
    {
    }

    public function notifyUserForShopOfferCreation(User $user): void
    {
        Log::info("Dispatching Async Job for user: $user->name");

        ShopOfferNotificationJob::dispatch($this->shopOffer, $user);
    }
}
