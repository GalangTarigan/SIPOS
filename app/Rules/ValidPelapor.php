<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Model\Daftar_Pic;
class ValidPelapor implements Rule
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
        return Daftar_Pic::where('id_pic', $value)->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Pelapor tidak terdaftar di database';
    }
}
