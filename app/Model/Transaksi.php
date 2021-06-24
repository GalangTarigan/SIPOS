<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $connection = 'mysql';
    protected $primaryKey = 'id_transaksi';
    protected $fillable = [
        'no_invoice', 'nama_pelanggan', 'alamat_pembeli', 'no_telepon_pembeli', 'users_id', 'tanggal_pembelian','total_pembelian', 'waktu_dibuat'
    ];
}
