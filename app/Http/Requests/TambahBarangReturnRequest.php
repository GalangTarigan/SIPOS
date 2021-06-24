<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TambahBarangReturnRequest extends FormRequest
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
        $rules = [
            'merk' => 'bail', 'required',
            'tipe_barang' => 'bail', 'required',
            'jumlah'=>'required|max:5',
            'kerusakan'=>'required|max:255',
        ];
        return $rules;

    }
    /**
     * Custom message for validation
     * @return array
     */
    public function messages()
    {
        return [
            'merk.required' => 'Merk barang tidak boleh kosong',
            'tipe_barang.required' => 'Tipe barang tidak boleh kosong',
            'jumlah.max'=>'Maksimal 5 digit angka',
            'jumlah.required'=> 'Kolom Stock tidak boleh kosong',
            'kerusakan.required'=>'Kolom Kerusakan tidak boleh kosong',
            'kerusakan.max'=>'Keterangan kerusakan melebihi batas maksimal karakter',
        ];
    }
}
