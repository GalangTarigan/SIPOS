<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadImageProfileRequest extends FormRequest
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
            'image'  => 'bail|required|image|mimes:jpeg,png,jpg,svg|max:3072'
        ];
    }
    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'image.image' => 'File harus berupa gambar',
            'image.max' => 'Ukuran setiap foto maksimal 3MB',
            'image.mimes' => 'Format foto tidak didukung'
        ];
    }
}
