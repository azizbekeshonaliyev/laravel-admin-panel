<?php

namespace Domain\Catalog\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CatalogCategoryStoreRequest extends FormRequest
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
            'active' => 'nullable|boolean',
            'parent_id' => 'nullable|exists:catalog_categories,id',
        ];
    }
}
