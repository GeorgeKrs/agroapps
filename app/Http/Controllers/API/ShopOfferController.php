<?php

namespace App\Http\Controllers\API;

use App\Data\ApiResponseData;
use App\Data\ShopOffer\ShopOfferData;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\ShopOffer\ShopOfferStoreRequest;
use App\Models\Shop;
use App\Models\ShopOffer;
use App\Repositories\ShopOfferRepository;
use App\Traits\Exceptionable;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;

class ShopOfferController extends Controller
{
    use Exceptionable;

    public function store(ShopOfferStoreRequest $request): JsonResponse
    {
        try {
            $payload = $request->safe()->toArray();
            $shop = Shop::query()->find($payload["shop_id"]);

            if (!Gate::allows("store", [ShopOffer::class, $shop])) {
                return ApiResponseData::unauthorized();
            }

            $shopOffer = ShopOfferRepository::store($payload);

            return ApiResponseData::success(
                message: 'Shop Offer created successfully!',
                data: ShopOfferData::fromModel($shopOffer)
            );

        } catch (Exception $exception) {
            $this->handleErrorException($exception);
            return ApiResponseData::error();
        }
    }
}
