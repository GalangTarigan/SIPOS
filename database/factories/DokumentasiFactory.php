<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Dokumentasi_Instalasi;
use Faker\Generator as Faker;
use Webpatser\Uuid\Uuid;

$factory->define(Dokumentasi_Instalasi::class, function (Faker $faker) {
    return [
        'uuid' => (string) Uuid::generate(),
        'laporan_instalasi_id' => 1,
        'keterangan' => 'foto',
        'dokumentasi' => 'dokumentasi/foto/fakeFoto.jpg'
    ];
});
