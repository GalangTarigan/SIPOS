<?php

use Illuminate\Database\Seeder;
use App\User;
use Webpatser\Uuid\Uuid;
class usersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $password = Hash::make('12345678');
        for ($i = 0; $i < 8; $i++) {
            User::create([
                'nama_lengkap' => $faker->name,
                'uuid' => (string) Uuid::generate(),
                'email' => $faker->unique()->email,
                'password' => $password,
                'no_telepon' => $faker->phoneNumber
            ]);
        }
        
        // User::create([
        //     'nama_lengkap' => 'Admin',
        //     'uuid' => (string) Uuid::generate(),
        //     'email' =>'admin@email.com',
        //     'password' => $password,
        //     'no_telepon' => $faker->phoneNumber,
        //     'role' => 'admin'
        // ]);
    }
}
