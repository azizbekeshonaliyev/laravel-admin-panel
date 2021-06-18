<?php

namespace Domain\Catalog\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'cover_image' => 'nullable|image|max:50000',
            'images' => 'nullable|array',
            'images.*' => 'nullable|image|max:50000',
            'price' => 'nullable|numeric',
            'in_stock' => 'nullable|numeric',
            'rank' => 'nullable|numeric',
            'active' => 'nullable|boolean',
            'category_id' => 'nullable|exists:catalog_categories,id',
        ];
    }
}
