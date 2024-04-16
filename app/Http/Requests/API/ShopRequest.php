<?php

namespace App\Http\Requests\API;

use App\Models\ShopCategory;
use App\Models\User;
use App\Rules\AllDaysOfWeekExistsRule;
use App\Rules\UniqueOrderValuesRule;
use Illuminate\Foundation\Http\FormRequest;

class ShopRequest extends FormRequest
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

    public function messages(): array
    {
        return [
            "name.required" => "Name is required",
            "name.string" => "Name must be of type string",
            "name.max" => "Name's max characters are 60",
            "owner_id.required" => "Owner id is required",
            "owner_id.exists" => "The owner id provided does not exist",
            "category_id.required" => "The category id is required",
            "category_id.exists" => "The category id provided does not exist",
            "city.required" => "City is required",
            "city.string" => "City must be of type string",
            "city.max" => "City's max characters are 60",
            "address.string" => "Address must be of type string",
            "address.max" => "Address max characters are 60",
            "open_hours.required" => "Open hours are required",
            "open_hours.array" => "Open hours must be an array",
            "open_hours.*.opening_time.required" => "Opening time is required for all days",
            "open_hours.*.opening_time.date_format" => "Opening time should be in the format H:i:s",
            "open_hours.*.closing_time.required" => "Closing time is required for all days",
            "open_hours.*.closing_time.date_format" => "Closing time should be in the format H:i:s",
            "open_hours.*.order.required" => "Order is required for all days",
            "open_hours.*.order.integer" => "Order should be an integer",
            "open_hours.*.order.min" => "Order should be at least 1",
            "open_hours.*.order.max" => "Order should be at most 7",
        ];
    }
}
