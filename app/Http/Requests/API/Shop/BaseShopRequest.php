<?php

namespace App\Http\Requests\API\Shop;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

abstract class BaseShopRequest extends FormRequest
{
    public abstract function rules(): array;

    public function messages(): array
    {
        return [
            "name.required" => "Name is required",
            "name.string" => "Name must be of type string",
            "name.max" => "Name's max characters are 60",
            "description.required" => "Description is required",
            "description.string" => "Description must be of type string",
            "description.max" => "Description's max characters are 500",
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

    public function getPreparedPayload(): array
    {
        $payload = $this->safe()->toArray();
        $payload["owner_id"] = Auth::user()->id;

        return $payload;
    }

}
