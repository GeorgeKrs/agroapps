<?php

namespace App\Http\Controllers\API;

use App\Data\ApiResponseData;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\ShopRequest;
use App\Models\Shop;
use App\Repositories\ShopRepository;
use Illuminate\Http\JsonResponse;

class ShopController extends Controller
{
    public function store(ShopRequest $request): JsonResponse
    {
        $shop = ShopRepository::store($request->safe()->toArray());

        return ApiResponseData::success(
            message: 'Shop created successfully!',
            data: $shop
        );
    }

    public function update(ShopRequest $request, Shop $shop): JsonResponse
    {
        $shop->repository()->update($request->safe()->toArray());

        return ApiResponseData::success(
            message: 'Shop updated successfully!',
            data: []
        );
    }
}
