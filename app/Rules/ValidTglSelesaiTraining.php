<?php

namespace App\Rules;
use Auth;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Carbon;
use App\Pkl\Traits\Convert;
use App\Pkl\Traits\LaporanInstalasi;
class ValidTglSelesaiTraining implements Rule
{
    use Convert, LaporanInstalasi;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected $waktuMulaiTraining;
    public function __construct($waktuMulaiTraining)
    {
        $this->waktuMulaiTraining = $waktuMulaiTraining;
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
        $dateConverted1 = $this->convertToTimeStamps($value); 
        $dateConverted2 = $this->convertToTimeStamps($this->waktuMulaiTraining); 
        $dateTrainingFinished = Carbon::createFromFormat('Y-m-d H:i:s', $dateConverted1, 'Asia/Jakarta');
        $dateTrainingStarted = Carbon::createFromFormat('Y-m-d H:i:s', $dateConverted2, 'Asia/Jakarta');
        $InstalationData = $this->getCurrentActiveUserProjects(Auth::user()->id);
        $dateInstalationStarted = Carbon::createFromFormat('Y-m-d H:i:s', $InstalationData->waktu_mulai, 'Asia/Jakarta');
        if($dateInstalationStarted->isBefore($dateTrainingFinished) && $dateTrainingStarted->isBefore($dateTrainingFinished) && $dateTrainingFinished->isBefore(Carbon::now())){
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
        return 'Tanggal dan waktu selesai training harus diset setelah tanggal & waktu mulai instalasi, tanggal mulai training serta harus terlewati dari waktu sekarang';
    }
}
