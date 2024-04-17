<?php

namespace App\Http\Controllers\API;

use App\Data\ApiResponseData;
use App\Data\Shop\ShopData;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Shop\ShopIndexRequest;
use App\Http\Requests\API\Shop\ShopStoreRequest;
use App\Http\Requests\API\Shop\ShopUpdateRequest;
use App\Models\Shop;
use App\Repositories\ShopRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class ShopController extends Controller
{
    public function index(ShopIndexRequest $request): JsonResponse
    {
        try {
            $filters = $request->safe()->toArray();

            return ApiResponseData::success(
                message: "Available Shops",
                data: ShopData::collect(
                    Shop::query()->filter(
                        ownerIds: $filters["owner_ids"] ?? null,
                        categoryIds: $filters["category_ids"] ?? null,
                        term: $filters["term"] ?? null,
                    )->get()
                )
            );
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Log::error($exception->getLine());
            Log::error($exception->getTraceAsString());

            return ApiResponseData::error();
        }
    }

    public function store(ShopStoreRequest $request): JsonResponse
    {
        try {
            if (Gate::allows("store", Shop::class)) {
                $shop = ShopRepository::store($request->safe()->toArray());

                return ApiResponseData::success(
                    message: "Shop created successfully!",
                    data: ShopData::fromModel($shop)
                );
            }

            return ApiResponseData::unauthorized();

        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Log::error($exception->getLine());
            Log::error($exception->getTraceAsString());

            return ApiResponseData::error();
        }
    }

    public function update(ShopUpdateRequest $request, Shop $shop): JsonResponse
    {
        try {
            if (Gate::allows("update", $shop)) {
                $shop->repository()->update($request->safe()->toArray());

                return ApiResponseData::success(message: "Shop updated successfully!", data: ShopData::fromModel($shop));
            }

            return ApiResponseData::unauthorized();
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Log::error($exception->getLine());
            Log::error($exception->getTraceAsString());

            return ApiResponseData::error();
        }
    }

    public function delete(Shop $shop): JsonResponse
    {
        try {
            if (Gate::allows("delete", $shop)) {
                $shop->repository()->delete();

                return ApiResponseData::success(message: "Shop deleted!");
            }

            return ApiResponseData::unauthorized();
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Log::error($exception->getLine());
            Log::error($exception->getTraceAsString());

            return ApiResponseData::error();
        }
    }
}
