<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'code' => 'required|string|max:255|unique:products,code,' . $this->route('product')?->id,
            'name' => 'required|string|max:255|unique:products,name,' . $this->route('product')?->id,
            'brand_id' => 'required|integer|exists:brands,id',
            'category_id' => 'required|integer|exists:categories,id',
            'price' => 'required|integer|min:0',
            'discount_percentage' => 'required|integer|min:0|max:100',
            'discount_from_date' => 'required|date',
            'discount_to_date' => 'required|date|after_or_equal:discount_from_date',
            'media_id' => 'required|integer|min:1',
            'inventory_qty' => 'required|integer|min:0',
            'description' => 'required|string|max:255',
            'star' => 'required|numeric|min:0|max:5',
            'featured' => 'required|integer|in:0,1',
            'status' => 'required|integer|in:0,1',
        ];
    }
}
