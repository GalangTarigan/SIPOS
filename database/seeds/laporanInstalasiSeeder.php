<?php

use Illuminate\Database\Seeder;
use App\Laporan_Instalasi;
class laporanInstalasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Laporan_Instalasi::create([
            'id_user' => 2, 
            'id_instansi' => 1, 
            'waktu_mulai' => '2019-07-13 10:00', 
            'waktu_selesai' => '2019-07-14 20:00', 
            'status' => 'Selesai'
        ]);
    }
}
