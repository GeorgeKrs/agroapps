<?php

namespace App\Observers;

use App\Models\ShopOffer;
use Illuminate\Support\Facades\Log;

class ShopOfferObserver
{
    public function created(ShopOffer $shopOffer): void
    {
        Log::debug(json_encode($shopOffer));
//      TODO: Add business logic for creating offer
    }
}
