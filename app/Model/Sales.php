<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    protected $table = 'sales';
    protected $connection = 'mysql';
    protected $primaryKey = 'id_sales';
    protected $fillable = [
        'nama_sales', 'no_telepon', 'nama_perusahaan', 'alamat', 'nama_no_rekening', 'product'
    ];
}
