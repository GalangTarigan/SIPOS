<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Dokumentasi_Bukti_Transfer extends Model
{
    protected $table = 'dokumentasi_bukti_transfer';
    protected $connection = 'mysql';
    protected $primaryKey = 'id_dokumentasi_transfer';
    protected $fillable = [
      'nama_file_transfer', 'tagihan_id'
    ];
}
