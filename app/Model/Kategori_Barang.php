<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Kategori_Barang extends Model
{
    protected $table = 'kategori_barang';
    protected $connection = 'mysql';
    protected $primaryKey = 'id_kategori';
    protected $fillable = [
        'nama_kategori'
    ];

}
