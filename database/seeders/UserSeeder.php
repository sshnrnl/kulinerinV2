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
        $faker = Faker::create();

        for ($i = 0; $i < 50; $i++) {
            DB::table('users')->insert([
                'email' => $faker->unique()->safeEmail,
                'username' => $faker->unique()->userName,
                'role' => '1',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        DB::table('users')->insert([
            [
                'id' => 51,
                'email' => $faker->unique()->safeEmail,
                'username' => $faker->unique()->userName,
                'role' => '2',
                'email_verified_at' => now(),
                'password' => bcrypt('qwerty123'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 52,
                'email' => $faker->unique()->safeEmail,
                'username' => $faker->unique()->userName,
                'role' => '2',
                'email_verified_at' => now(),
                'password' => bcrypt('qwerty123'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 53,
                'email' => $faker->unique()->safeEmail,
                'username' => $faker->unique()->userName,
                'role' => '2',
                'email_verified_at' => now(),
                'password' => bcrypt('qwerty123'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 54,
                'email' => $faker->unique()->safeEmail,
                'username' => $faker->unique()->userName,
                'role' => '2',
                'email_verified_at' => now(),
                'password' => bcrypt('qwerty123'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 55,
                'email' => $faker->unique()->safeEmail,
                'username' => $faker->unique()->userName,
                'role' => '2',
                'email_verified_at' => now(),
                'password' => bcrypt('qwerty123'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 56,
                'email' => $faker->unique()->safeEmail,
                'username' => $faker->unique()->userName,
                'role' => '2',
                'email_verified_at' => now(),
                'password' => bcrypt('qwerty123'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 57,
                'email' => $faker->unique()->safeEmail,
                'username' => $faker->unique()->userName,
                'role' => '2',
                'email_verified_at' => now(),
                'password' => bcrypt('qwerty123'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 58,
                'email' => $faker->unique()->safeEmail,
                'username' => $faker->unique()->userName,
                'role' => '2',
                'email_verified_at' => now(),
                'password' => bcrypt('qwerty123'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 59,
                'email' => $faker->unique()->safeEmail,
                'username' => $faker->unique()->userName,
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
