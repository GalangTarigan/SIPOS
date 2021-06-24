<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DashboardBarchart extends FormRequest
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
            'date_start' => 'bail|required|date_format:d/m/Y H:i',
            'date_end' => 'bail|required|date_format:d/m/Y H:i',
            'q_status' => ['bail', 'required', Rule::in(['all', 'fin'])]
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
            'date_start.required' => 'Input tanggal mulai harus diisi',
            'date_start.date_format' => 'Input harus berformat tanggal dan waktu',
            'date_end.required' => 'Input tanggal mulai harus diisi',
            'date_end.date_format' => 'Input harus berformat tanggal dan waktu',
            'q_status.required' => 'Input query tidak boleh kosong'
        ];
    }
}
