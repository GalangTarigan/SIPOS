<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Dokumentasi_barang extends Model
{
    protected $table = 'dokumentasi_barang';
    protected $connection = 'mysql';
    protected $primaryKey = 'id_dokumentasi';
    protected $fillable = [
      'nama_file', 'barang_id'
    ];
}
