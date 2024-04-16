<?php

namespace App\Http\Requests\API\Shop;

use App\Models\ShopCategory;
use App\Models\User;
use App\Rules\AllDaysOfWeekExistsRule;
use App\Rules\UniqueOrderValuesRule;

class ShopStoreRequest extends BaseShopRequest
{
    public function rules(): array
    {
        return [
            "name" => 'required|string|max:60',
            "description" => 'required|string|max:500',
            "owner_id" => 'required|exists:' . User::class . ',id',
            "category_id" => 'required|exists:' . ShopCategory::class . ',id',
            "city" => 'required|string|max:60',
            "address" => 'nullable|string|max:60',
            "open_hours" => ['required', 'array', new AllDaysOfWeekExistsRule, new UniqueOrderValuesRule],
            "open_hours.*.opening_time" => 'required|date_format:H:i:s',
            "open_hours.*.closing_time" => 'required|date_format:H:i:s',
            "open_hours.*.order" => 'required|integer|min:1|max:14',
        ];
    }
}
