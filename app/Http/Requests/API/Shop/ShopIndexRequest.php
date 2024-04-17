<?php

namespace App\Http\Requests\API\Shop;

use Illuminate\Foundation\Http\FormRequest;

class ShopIndexRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'owner_ids' => 'nullable|array',
            'category_ids' => 'nullable|array',
            'term' => 'nullable|string',
        ];
    }
}


