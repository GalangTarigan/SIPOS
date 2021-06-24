<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class tambahBarangBaruRequest extends FormRequest
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
            'merk' =>  'required',
            'tipe_barang' => 'required',
            'jumlah' => 'required|max:3|min:1',
            'modal' => 'required|min:1',
            'jual'=> 'required|min:1',
            'nama_sales'=> 'required', 
            'keterangan_barang'=> 'required|max:255',
            'kategori_barang'=> 'required',

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
            'jumlah.max'=>'Maksimal 3 digit angka',
            'jumlah.min'=>'Maksimal 1 digit angka',
            'jumlah.required'=> 'Stock barang tidak boleh kosong',            
            'modal.min'=>'Minimal 1 digit angka',
            'modal.required'=> 'Harga modal tidak boleh kosong',
            'jual.min'=>'Minimal 1 digit angka',
            'jual.required'=> 'Harga jual tidak boleh kosong',
            'nama_sales.required' => 'Nama sales tidak boleh kosong',
            'keterangan_barang.max'=> 'Keterangan barang maksimal 255 karakter',
            'keterangan.required'=> 'Keterangan barang tidak boleh kosong', 
            'kategori_Barang.required' => 'Tipe barang tidak boleh kosong',
        ];
    }
}
