<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddMerkRequest extends FormRequest
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
            'nama_merk'=>'required|unique:merk_barang',
        ];
    }

    public function messages(){
        return [
            'nama_merk.unique'=>'Maaf, Merk baru yang ingin didaftarkan sudah tersedia',
        ];
        }
}
