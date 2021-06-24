<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Dokumentasi_Barang_Service extends Model
{
    protected $table = 'dokumentasi_barang_service';
    protected $connection = 'mysql';
    protected $primaryKey = 'id_dokumentasi_service';
    protected $fillable = [
      'nama_file_service', 'service_id'
    ];
}
