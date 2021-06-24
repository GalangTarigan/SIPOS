<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Dokumentasi_Tagihan extends Model
{
    protected $table = 'dokumentasi_tagihan';
    protected $connection = 'mysql';
    protected $primaryKey = 'id_dokumentasi_tagihan';
    protected $fillable = [
      'nama_file_tagihan', 'tagihan_id'
    ];
}
