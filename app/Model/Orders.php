<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table = 'orders';
    protected $connection = 'mysql';
    protected $primaryKey = 'id_orders';
    protected $fillable = [
        'barang_id', 'transaksi_id', 'jumlah_barang_beli', 'created_at_order', 
        'kategori_barang', 'merk_barang_beli', 'tipe_barang_beli', 'harga_barang_beli', 'total_harga', 'batas_garansi'
    ];
}
