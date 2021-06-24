<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditBarangServiceRequest extends FormRequest
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
            'modal_biaya_service'=>'required',
        ];
    }

    public function messages(){
        return [
            'modal_biaya_service.required'=>'Maaf, tidak boleh kosong',
        ];
        }
}
