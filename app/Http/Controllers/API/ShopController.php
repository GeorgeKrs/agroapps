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
use App\Traits\Exceptionable;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;

class ShopController extends Controller
{
    use Exceptionable;

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
        } catch (Exception $exception) {
            $this->handleErrorException($exception);
            return ApiResponseData::error();
        }
    }

    public function store(ShopStoreRequest $request): JsonResponse
    {
        try {
            if (!Gate::allows("store", Shop::class)) {
                return ApiResponseData::unauthorized();
            }

            $shop = ShopRepository::store($request->safe()->toArray());

            return ApiResponseData::success(
                message: "Shop created successfully!",
                data: ShopData::fromModel($shop)
            );

        } catch (Exception $exception) {
            $this->handleErrorException($exception);
            return ApiResponseData::error();
        }
    }

    public function update(ShopUpdateRequest $request, Shop $shop): JsonResponse
    {
        try {
            if (!Gate::allows("update", $shop)) {
                return ApiResponseData::unauthorized();
            }

            $shop->repository()->update($request->safe()->toArray());
            return ApiResponseData::success(message: "Shop updated successfully!", data: ShopData::fromModel($shop));

        } catch (Exception $exception) {
            $this->handleErrorException($exception);
            return ApiResponseData::error();
        }
    }

    public function delete(Shop $shop): JsonResponse
    {
        try {
            if (!Gate::allows("delete", $shop)) {
                return ApiResponseData::unauthorized();
            }

            $shop->repository()->delete();
            return ApiResponseData::success(message: "Shop deleted!");

        } catch (Exception $exception) {
            $this->handleErrorException($exception);
            return ApiResponseData::error();
        }
    }
}
