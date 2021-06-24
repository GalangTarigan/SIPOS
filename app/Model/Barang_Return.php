<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Barang_Return extends Model
{
    protected $table = 'barang_return';
    protected $connection = 'mysql';
    protected $primaryKey = 'id_barang_return';
    protected $fillable = [
      'kerusakan', 'jumlah', 'status', 'tanggal_pengambilan', 'sales_id', 'no_seri'
    ];
}
