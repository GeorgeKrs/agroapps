<?php

namespace App\Http\Requests\API\Shop;

use App\Models\ShopCategory;
use App\Models\User;
use App\Rules\AllDaysOfWeekExistsRule;
use App\Rules\UniqueOrderValuesRule;
use Illuminate\Foundation\Http\FormRequest;

class ShopUpdateRequest extends BaseShopRequest
{
    public function rules(): array
    {
        return [
            "name" => 'nullable|string|max:60',
            "description" => 'nullable|string|max:500',
            "category_id" => 'nullable|exists:' . ShopCategory::class . ',id',
            "city" => 'nullable|string|max:60',
            "address" => 'nullable|string|max:60',
            "open_hours" => ['nullable', 'array', new AllDaysOfWeekExistsRule, new UniqueOrderValuesRule],
            "open_hours.*.opening_time" => 'nullable|date_format:H:i:s',
            "open_hours.*.closing_time" => 'nullable|date_format:H:i:s',
            "open_hours.*.order" => 'nullable|integer|min:1|max:14',
        ];
    }
}
