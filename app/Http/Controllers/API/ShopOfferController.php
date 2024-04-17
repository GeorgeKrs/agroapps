<?php

namespace App\Http\Controllers\API;

use App\Data\ApiResponseData;
use App\Data\ShopOffer\ShopOfferData;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\ShopOffer\ShopOfferStoreRequest;
use App\Repositories\ShopOfferRepository;
use App\Traits\Exceptionable;
use Exception;
use Illuminate\Http\JsonResponse;

class ShopOfferController extends Controller
{
    use Exceptionable;

    public function store(ShopOfferStoreRequest $request): JsonResponse
    {
        try {
            $shopOffer = ShopOfferRepository::store($request->safe()->toArray());

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
