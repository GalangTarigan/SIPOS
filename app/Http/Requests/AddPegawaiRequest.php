<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddPegawaiRequest extends FormRequest
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
            'nama_lengkap'=>'required|max:50',
            'email'=>'required|email|unique:users',
            // 'email' => 'requred|unique:users,email',
            'password'=>'required|min:8',
            'password_confirmation'=>'same:password',
            'alamat'=>'required|max:50',
            'no_telepon'=>'required|min:9|max:12',
        ];
    }
    public function messages(){
        return[
            'nama_lengkap.required'=>'Kolom Nama Lengkap tidak boleh kosong',
            'nama_lengkap.max'=>'Nama lengkap maksimal 50 karakter',
            'email.required'=>'Kolom Email tidak boleh kosong',
            'email.email'=>'Format email salah ',            
            'email.unique'=>'Email yang ingin didaftarkan sudah tersedia',
            'password.min'=>'Password minimal 8 karakter',
            'password_confirmation.same'=>'Password harus sama',
            'alamat.required'=>'Kolom Alamat tidak boleh kosong',
            'alamat.max'=>'Alamat maksimal 50 karakter',
            'no_telepon.required'=>'Kolom No. Telepon tidak boleh kosong',
            'no_telepon.min'=>'Minimal 9 digit',
            'no_telepon.max'=>'Maximal 12 digit'
        ];
    }
}
