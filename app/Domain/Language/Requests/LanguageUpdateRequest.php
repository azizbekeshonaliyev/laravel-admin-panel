<?php

namespace App\Domain\Language\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LanguageUpdateRequest extends FormRequest
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
        $lang = $this->route('language');

        return [
            'name' => 'required',
            'locale' => 'required|unique:languages,locale,'.$lang->id,
            'rank' => 'nullable|numeric',
        ];
    }
}
