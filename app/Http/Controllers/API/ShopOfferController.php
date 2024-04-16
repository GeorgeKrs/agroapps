<?php

namespace App\Http\Controllers\API;

use App\Data\ApiResponseData;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\ShopOffer\ShopOfferStoreRequest;
use App\Repositories\ShopOfferRepository;
use Illuminate\Http\JsonResponse;

class ShopOfferController extends Controller
{
    public function store(ShopOfferStoreRequest $request): JsonResponse
    {
        $shopOffer = ShopOfferRepository::store($request->safe()->toArray());

        return ApiResponseData::success(
            message: 'Shop Offer created successfully!',
            data: $shopOffer
        );
    }
}
