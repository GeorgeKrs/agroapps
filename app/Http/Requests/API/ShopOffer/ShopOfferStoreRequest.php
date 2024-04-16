<?php

namespace App\Http\Requests\API\ShopOffer;

use App\Models\Shop;
use Illuminate\Foundation\Http\FormRequest;

class ShopOfferStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "name" => 'required|string|max:60',
            "description" => 'required|string|max:500',
            "shop_id" => 'required|exists:' . Shop::class . ',id',
        ];
    }

    public function messages(): array
    {
        return [
            "name.required" => "Name is required",
            "name.string" => "Name must be of type string",
            "name.max" => "Name's max characters are 60",
            "description.required" => "Description is required",
            "description.string" => "Description must be of type string",
            "description.max" => "Description's max characters are 500",
            "shop_id.required" => "Shop id is required",
            "shop_id.exists" => "The shop id provided does not exist",
        ];
    }
}


