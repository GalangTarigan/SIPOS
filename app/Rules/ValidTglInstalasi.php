<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

use Illuminate\Support\Carbon;

use App\Pkl\Traits\Convert;

class ValidTglInstalasi implements Rule
{
    use Convert;
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
        $dateConverted = $this->convertToTimeStamps($value); 
        $date = Carbon::createFromFormat('Y-m-d H:i:s', $dateConverted, 'Asia/Jakarta');
        $now = Carbon::now();
        return $date->lt($now);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Tanggal dan waktu instalasi belum terlewati';
    }
}
