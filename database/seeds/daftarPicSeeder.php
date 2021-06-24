<?php

use Illuminate\Database\Seeder;
use App\Model\Daftar_Pic;
class daftarPicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 3; $i++) {
            Daftar_Pic::create([
                'instansi_id' => 1,
                'nama_pic' => 'Dude Herlino'.$i,
                'kontak_pic' => '080000'.$i+1
            ]);
        }
    }
}
