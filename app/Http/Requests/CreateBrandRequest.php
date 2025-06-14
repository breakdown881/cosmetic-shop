<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBrandRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:brands,name,' . $this->route('brand')?->id,
            'image' => 'image|mimes:jpg,jpeg,png|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => __('translate.required', ['attribute' => 'Name']),
            'name.max'      => __('translate.max.string', ['attribute' => 'Name', 'max' => 255]),
            'name.unique'   => __('translate.unique', ['attribute' => 'Name']),
            'image.image'   => __('translate.image.type'),
            'image.mimes'   => __('translate.image.mimes'),
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => __('translate.name'),
        ];
    }
}
