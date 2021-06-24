<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Carbon;
use App\Pkl\Traits\Convert;
class ValidTglSelesaiPenanganan implements Rule
{
    use Convert;    
    protected $waktuLapor;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($waktuLapor)
    {
        $this->waktuLapor = $waktuLapor;
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
        $waktuLapor = Carbon::createFromFormat('Y-m-d H:i:s', $this->convertToTimeStamps($this->waktuLapor), 'Asia/Jakarta');
        $waktuSelesaiPenanganan = Carbon::createFromFormat('Y-m-d H:i:s', $this->convertToTimeStamps($value), 'Asia/Jakarta');
        if($waktuSelesaiPenanganan->isAfter($waktuLapor) && $waktuSelesaiPenanganan->isBefore(Carbon::now())){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Tanggal dan waktu selesai penanganan harus setelah waktu lapor dan telah terlewati dari waktu sekarang';
    }
}
