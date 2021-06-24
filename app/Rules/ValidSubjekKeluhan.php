<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Model\Subjek_Keluhan;
class ValidSubjekKeluhan implements Rule
{
    protected $counter;
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
        
        $this->counter = count($value);
        $boolean = true;
        foreach(range(0, $this->counter) as $index){
            if(Subjek_Keluhan::where('id_subjek', $value[$index])->exists()) return true;
            else return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "Subjek yang anda pilih tidak terdaftar dalam database";
    }
}
