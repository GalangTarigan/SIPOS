<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Model\Instansi;
class ValidInstansi implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return Instansi::where('id_instansi', $value)->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Instansi tidak terdaftar di database';
    }
}
