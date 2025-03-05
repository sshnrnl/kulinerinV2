<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'email' => 'lawry@gmail.com',
                'username' => 'Lawry',
                'role' => '2',
                'email_verified_at' => now(),
                'password' => bcrypt('qwerty123'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'email' => 'anigre@gmail.com',
                'username' => 'Anigre',
                'role' => '2',
                'email_verified_at' => now(),
                'password' => bcrypt('qwerty123'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'email' => 'nusaindonesia@gmail.com',
                'username' => 'Nusa Indonesia',
                'role' => '2',
                'email_verified_at' => now(),
                'password' => bcrypt('qwerty123'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'email' => 'blanco@gmail.com',
                'username' => 'Blanco',
                'role' => '2',
                'email_verified_at' => now(),
                'password' => bcrypt('qwerty123'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'email' => 'the1945restaurant@gmail.com',
                'username' => NULL,
                'role' => '2',
                'email_verified_at' => now(),
                'password' => bcrypt('qwerty123'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 7,
                'email' => 'grandhyat@gmail.com',
                'username' => 'Grand Hyat',
                'role' => '2',
                'email_verified_at' => now(),
                'password' => bcrypt('qwerty123'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 8,
                'email' => 'viewrestaurant@gmail.com',
                'username' => NULL,
                'role' => '2',
                'email_verified_at' => now(),
                'password' => bcrypt('qwerty123'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 9,
                'email' => 'justus@gmail.com',
                'username' => 'Justus',
                'role' => '2',
                'email_verified_at' => now(),
                'password' => bcrypt('qwerty123'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 10,
                'email' => 'merahputih@gmail.com',
                'username' => NULl,
                'role' => '2',
                'email_verified_at' => now(),
                'password' => bcrypt('qwerty123'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
