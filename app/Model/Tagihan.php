<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    protected $table = 'tagihan';
    protected $connection = 'mysql';
    protected $primaryKey = 'id_tagihan';
    protected $fillable = [
        'jatuh_tempo', 'tanggal_dibayar','tanggal_faktur', 'jumlah_tagihan', 'foto', 'status_pembayaran', 
        'metode_pembayaran','sales_id', 'users_id', 'no_faktur'
    ];
}
