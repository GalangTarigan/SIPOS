<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Catatan_Service extends Model
{
    protected $table = 'catatan_service';
    protected $connection = 'mysql';
    protected $primaryKey = 'id_service';
    protected $fillable = [
      'nama_pelanggan', 'no_telepon', 'jenis_barang', 'permasalahan', 'kelengkapan', 'lokasi_barang', 'foto', 
      'status_barang', 'users_id', 'total_biaya_service', 'modal_biaya_service', 'note_tidak_dapat_diperbaiki',
      'status_pembayaran'

    ];
}
