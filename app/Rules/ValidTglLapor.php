<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Carbon;
use App\Pkl\Traits\Convert;
use App\Model\Instansi;
class ValidTglLapor implements Rule
{
    use Convert;
    protected $instansi_id;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->instansi_id = $id;
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
        $laporan_instalasi = Instansi::findOrFail($this->instansi_id)->laporan_instalasi->toArray();
        $laporan_instalasi_terakhir = end($laporan_instalasi);
        $laporan_instalasi_terakhir = $laporan_instalasi_terakhir;
        $waktuSelesaiProyek = Carbon::createFromFormat('Y-m-d H:i:s', $laporan_instalasi_terakhir['waktu_selesai'], 'Asia/Jakarta');
        $waktuLapor = Carbon::createFromFormat('Y-m-d H:i:s', $this->convertToTimeStamps($value), 'Asia/Jakarta');
        if($waktuLapor->isAfter($waktuSelesaiProyek) && $waktuLapor->isBefore(Carbon::now())) {
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
        return 'Tanggal dan waktu lapor harus setelah proyek instalasi selesai dan telah terlewati dari waktu sekarang';
    }
}
