<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Catatan_Laba_rugi extends Model
{
    protected $table = 'catatan_laba_rugi';
    protected $connection = 'mysql';
    protected $primaryKey = 'id_pengeluaran';
    protected $fillable = [
      'service_id', 'keterangan', 'biaya_modal', 'pendapatan', 'tanggal_transaksi_laba_rugi', 'transaksi_id'
    ];
}
