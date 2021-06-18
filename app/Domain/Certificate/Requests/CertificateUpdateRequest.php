<?php

namespace App\Domain\Certificate\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CertificateUpdateRequest extends FormRequest
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
            'rank' => 'nullable|numeric',
            'active' => 'nullable|boolean',
        ];
    }
}
