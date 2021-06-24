<?php

namespace App\Rules;
use Auth;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Carbon;
use App\Pkl\Traits\Convert;
use App\Pkl\Traits\LaporanInstalasi;



class ValidTglMulaiTraining implements Rule
{
    use LaporanInstalasi, Convert;
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
        $dateTraining = Carbon::createFromFormat('Y-m-d H:i:s', $dateConverted, 'Asia/Jakarta');
        $InstalationData = $this->getCurrentActiveUserProjects(Auth::user()->id);
        $dateInstalationStarted = Carbon::createFromFormat('Y-m-d H:i:s', $InstalationData->waktu_mulai, 'Asia/Jakarta');
        if($dateInstalationStarted->isBefore($dateTraining) && $dateTraining->isBefore(Carbon::now())){
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
        return 'Tanggal & waktu mulai training harus diset setelah tanggal mulai instalasi & harus sudah terlewati dari waktu sekarang';
    }
}
