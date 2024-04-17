<?php

namespace App\Http\Controllers\API;

use App\Data\ApiResponseData;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Shop\ShopIndexRequest;
use App\Http\Requests\API\Shop\ShopStoreRequest;
use App\Http\Requests\API\Shop\ShopUpdateRequest;
use App\Models\Shop;
use App\Repositories\ShopRepository;
use Illuminate\Http\JsonResponse;

class ShopController extends Controller
{
    public function index(ShopIndexRequest $request): JsonResponse
    {
        $filters = $request->safe()->toArray();

        return ApiResponseData::success(
            message: "Available Shops",
            data: Shop::query()
                ->filter(
                    ownerIds: $filters["owner_ids"] ?? null,
                    categoryIds: $filters["category_ids"] ?? null,
                    term: $filters["term"] ?? null,
                )
                ->get()
        );
    }

    public function store(ShopStoreRequest $request): JsonResponse
    {
        $shop = ShopRepository::store($request->safe()->toArray());

        return ApiResponseData::success(
            message: "Shop created successfully!",
            data: $shop
        );
    }

    public function update(ShopUpdateRequest $request, Shop $shop): JsonResponse
    {
        $shop->repository()->update($request->safe()->toArray());

        return ApiResponseData::success(message: "Shop updated successfully!");
    }

    public function delete(Shop $shop): JsonResponse
    {
        $shop->repository()->delete();

        return ApiResponseData::success(message: "Shop deleted!");
    }
}
