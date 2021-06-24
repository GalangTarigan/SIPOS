<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Merk_Barang extends Model
{
    protected $table = 'merk_barang';
    protected $connection = 'mysql';
    protected $primaryKey = 'id_merk';
    protected $fillable = [
        'nama_merk'
    ];

}
