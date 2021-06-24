<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table = 'dokumentasi_instalasi';
    protected $fillable = [
        'id_laporan',
        'title',
        'dokumentasi'
    ];
}
