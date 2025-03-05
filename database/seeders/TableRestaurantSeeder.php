<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TableRestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('table_restaurants')->insert([
            //Lawry
            [
                'id' => 1,
                'restaurant_id' => 1,
                'tableCapacity' => '4',
                'availableTables' => '4',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'restaurant_id' => 1,
                'tableCapacity' => '8',
                'availableTables' => '5',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'restaurant_id' => 1,
                'tableCapacity' => '10',
                'availableTables' => '2',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            //Anigre
            [
                'id' => 4,
                'restaurant_id' => 2,
                'tableCapacity' => '4',
                'availableTables' => '4',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'restaurant_id' => 2,
                'tableCapacity' => '8',
                'availableTables' => '3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'restaurant_id' => 2,
                'tableCapacity' => '12',
                'availableTables' => '4',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Nusa
            [
                'id' => 7,
                'restaurant_id' => 3,
                'tableCapacity' => '2',
                'availableTables' => '5',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 8,
                'restaurant_id' => 3,
                'tableCapacity' => '6',
                'availableTables' => '5',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            //Blanco
            [
                'id' => 9,
                'restaurant_id' => 5,
                'tableCapacity' => '4',
                'availableTables' => '4',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 10,
                'restaurant_id' => 5,
                'tableCapacity' => '4',
                'availableTables' => '4',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // The 1945
            [
                'id' => 11,
                'restaurant_id' => 6,
                'tableCapacity' => '4',
                'availableTables' => '4',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 12,
                'restaurant_id' => 6,
                'tableCapacity' => '6',
                'availableTables' => '4',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            //Grand Hyat
            [
                'id' => 13,
                'restaurant_id' => 7,
                'tableCapacity' => '3',
                'availableTables' => '5',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 14,
                'restaurant_id' => 7,
                'tableCapacity' => '6',
                'availableTables' => '8',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            //View Restaurant & Bar
            [
                'id' => 15,
                'restaurant_id' => 8,
                'tableCapacity' => '4',
                'availableTables' => '4',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 16,
                'restaurant_id' => 8,
                'tableCapacity' => '7',
                'availableTables' => '4',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            //Justus
            [
                'id' => 17,
                'restaurant_id' => 9,
                'tableCapacity' => '4',
                'availableTables' => '4',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 18,
                'restaurant_id' => 9,
                'tableCapacity' => '6',
                'availableTables' => '4',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            //Merah Putih
            [
                'id' => 19,
                'restaurant_id' => 10,
                'tableCapacity' => '4',
                'availableTables' => '4',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 20,
                'restaurant_id' => 10,
                'tableCapacity' => '8',
                'availableTables' => '4',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 21,
                'restaurant_id' => 10,
                'tableCapacity' => '12',
                'availableTables' => '4',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
