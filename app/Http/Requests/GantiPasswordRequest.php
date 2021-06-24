<?php

namespace App\Http\Requests;

use App\Rules\ValidPasswordDatabase as validPasswordDatabase;
use Illuminate\Foundation\Http\FormRequest;


class GantiPasswordRequest extends FormRequest
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
            'old_password'=>['required',new validPasswordDatabase],
            'password'=>'required|min:8|different:old_password',
            'password_confirmation'=>'required|same:password',
        ];
    }
    public function messages(){
        return [
            'old_password.required'=>'Kolom harus diisi',
            'password.required'=>'Kolom harus diisi',
            'password.different'=>'Password tidak boleh sama dengan password yang lama',
            'password.min'=>'Password minimal 8 karakter',
            'password_confirmation.required'=>'Kolom harus diisi',
            'password_confirmation.same'=>'Password harus sama dengan password baru',
            
        ];
    }
}
