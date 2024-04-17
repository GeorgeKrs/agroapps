<?php

namespace App\Observers;

use App\Models\ShopOffer;
use App\Models\User;
use App\Services\ShopOfferNotificationService;

class ShopOfferObserver
{
    public function created(ShopOffer $shopOffer): void
    {
        $service = new ShopOfferNotificationService($shopOffer);

        foreach (User::all() as $user) {
            $service->notifyUserForShopOfferCreation($user);
        }
    }
}
