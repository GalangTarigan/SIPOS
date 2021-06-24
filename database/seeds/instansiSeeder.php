<?php

use Illuminate\Database\Seeder;
use App\Instansi;
class instansiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 3; $i++) {
            Instansi::create([
                'nama_instansi' => 'Puskesmas '.$i,
                'kategori' => 'Puskesmas',
                'alamat_instansi' => $faker->address,
                'email' => $faker->unique()->email,
                'no_telepon' => $faker->phoneNumber
            ]);
        }
        for ($i = 0; $i < 3; $i++) {
            Instansi::create([
                'nama_instansi' => 'Rumah Sakit '.$i,
                'kategori' => 'Rumah Sakit',
                'alamat_instansi' => $faker->address,
                'email' => $faker->unique()->email,
                'no_telepon' => $faker->phoneNumber
            ]);
        }
        for ($i = 0; $i < 3; $i++) {
            Instansi::create([
                'nama_instansi' => 'Kantor '.$i,
                'kategori' => 'Kantor',
                'alamat_instansi' => $faker->address,
                'email' => $faker->unique()->email,
                'no_telepon' => $faker->phoneNumber
            ]);
        }
    }
}
