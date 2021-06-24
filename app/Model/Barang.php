<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';
    protected $connection = 'mysql';
    protected $primaryKey = 'id_barang';
    protected $fillable = [
        'tipe_barang', 'jumlah', 'modal', 'jual', 'keterangan_barang', 'kategori_id', 'sales_id', 
    ];

    // public function daftar_kategori(){
    //     return $this->hasMany(Kategori_Barang::class, 'id_kategori');
    // }

}
