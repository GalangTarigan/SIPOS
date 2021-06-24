<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Regencies extends Model
{
    protected $connection = 'mysql';
    protected $table = 'regencies';
    protected function provinces(){
        return $this->belongsTo('App\Model\Provinces');
    }

}
