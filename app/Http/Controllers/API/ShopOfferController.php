<?php

namespace App\Http\Controllers\API;

use App\Data\ApiResponseData;
use App\Data\ShopOffer\ShopOfferData;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\ShopOffer\ShopOfferStoreRequest;
use App\Repositories\ShopOfferRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class ShopOfferController extends Controller
{
    public function store(ShopOfferStoreRequest $request): JsonResponse
    {
        try {
            $shopOffer = ShopOfferRepository::store($request->safe()->toArray());

            return ApiResponseData::success(
                message: 'Shop Offer created successfully!',
                data: ShopOfferData::fromModel($shopOffer)
            );

        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Log::error($exception->getLine());
            Log::error($exception->getTraceAsString());

            return ApiResponseData::error();
        }
    }
}
