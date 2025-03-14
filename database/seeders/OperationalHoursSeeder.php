<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OperationalHoursSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    //Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'
    public function run()
    {
        DB::table('operational_hours')->insert([
            //Lawry's
            [
                'id' => 1,
                'restaurant_id' => 1,
                'day' => "Monday",
                'open_time' => "08:00:00",
                'close_time' => "22:00:00"
            ],
            [
                'id' => 2,
                'restaurant_id' => 1,
                'day' => "Tuesday",
                'open_time' => "08:00:00",
                'close_time' => "22:00:00"
            ],
            [
                'id' => 3,
                'restaurant_id' => 1,
                'day' => "Wednesday",
                'open_time' => "08:00:00",
                'close_time' => "22:00:00"
            ],
            [
                'id' => 4,
                'restaurant_id' => 1,
                'day' => "Thursday",
                'open_time' => "08:00:00",
                'close_time' => "22:00:00"
            ],
            [
                'id' => 5,
                'restaurant_id' => 1,
                'day' => "Friday",
                'open_time' => "08:00:00",
                'close_time' => "22:00:00"
            ],
            [
                'id' => 6,
                'restaurant_id' => 1,
                'day' => "Saturday",
                'open_time' => "08:00:00",
                'close_time' => "22:00:00"
            ],
            [
                'id' => 7,
                'restaurant_id' => 1,
                'day' => "Sunday",
                'open_time' => "08:00:00",
                'close_time' => "22:00:00"
            ],

            //Anigre
            [
                'id' => 8,
                'restaurant_id' => 2,
                'day' => "Monday",
                'open_time' => "08:00:00",
                'close_time' => "22:00:00"
            ],
            [
                'id' => 9,
                'restaurant_id' => 2,
                'day' => "Tuesday",
                'open_time' => "08:00:00",
                'close_time' => "22:00:00"
            ],
            [
                'id' => 10,
                'restaurant_id' => 2,
                'day' => "Wednesday",
                'open_time' => "08:00:00",
                'close_time' => "22:00:00"
            ],
            [
                'id' => 11,
                'restaurant_id' => 2,
                'day' => "Thursday",
                'open_time' => "08:00:00",
                'close_time' => "22:00:00"
            ],
            [
                'id' => 12,
                'restaurant_id' => 2,
                'day' => "Friday",
                'open_time' => "08:00:00",
                'close_time' => "22:00:00"
            ],
            [
                'id' => 13,
                'restaurant_id' => 2,
                'day' => "Saturday",
                'open_time' => "10:00:00",
                'close_time' => "22:00:00"
            ],
            // [
            //     'id' => 14,
            //     'restaurant_id' => 2,
            //     'day' => "Sunday",
            //     'open_time' => "08:00:00",
            //     'close_time' => "22:00:00"
            // ],

            //Nusa
            [
                'id' => 14,
                'restaurant_id' => 3,
                'day' => "Monday",
                'open_time' => "09:00:00",
                'close_time' => "22:00:00"
            ],
            [
                'id' => 15,
                'restaurant_id' => 3,
                'day' => "Tuesday",
                'open_time' => "09:00:00",
                'close_time' => "22:00:00"
            ],
            [
                'id' => 16,
                'restaurant_id' => 3,
                'day' => "Wednesday",
                'open_time' => "09:00:00",
                'close_time' => "22:00:00"
            ],
            [
                'id' => 17,
                'restaurant_id' => 3,
                'day' => "Thursday",
                'open_time' => "09:00:00",
                'close_time' => "22:00:00"
            ],
            [
                'id' => 18,
                'restaurant_id' => 3,
                'day' => "Friday",
                'open_time' => "08:00:00",
                'close_time' => "22:00:00"
            ],
            [
                'id' => 19,
                'restaurant_id' => 3,
                'day' => "Saturday",
                'open_time' => "12:00:00",
                'close_time' => "22:00:00"
            ],
            [
                'id' => 20,
                'restaurant_id' => 3,
                'day' => "Sunday",
                'open_time' => "08:00:00",
                'close_time' => "20:00:00"
            ],

            //Blanco
            [
                'id' => 21,
                'restaurant_id' => 5,
                'day' => "Monday",
                'open_time' => "09:00:00",
                'close_time' => "22:00:00"
            ],
            [
                'id' => 22,
                'restaurant_id' => 5,
                'day' => "Tuesday",
                'open_time' => "09:00:00",
                'close_time' => "22:00:00"
            ],
            [
                'id' => 23,
                'restaurant_id' => 5,
                'day' => "Wednesday",
                'open_time' => "09:00:00",
                'close_time' => "22:00:00"
            ],
            [
                'id' => 24,
                'restaurant_id' => 5,
                'day' => "Thursday",
                'open_time' => "09:00:00",
                'close_time' => "22:00:00"
            ],
            [
                'id' => 25,
                'restaurant_id' => 5,
                'day' => "Friday",
                'open_time' => "08:00:00",
                'close_time' => "22:00:00"
            ],
            [
                'id' => 26,
                'restaurant_id' => 5,
                'day' => "Saturday",
                'open_time' => "09:00:00",
                'close_time' => "22:00:00"
            ],
            [
                'id' => 27,
                'restaurant_id' => 5,
                'day' => "Sunday",
                'open_time' => "08:00:00",
                'close_time' => "21:00:00"
            ],

            //The 1945
            [
                'id' => 28,
                'restaurant_id' => 6,
                'day' => "Monday",
                'open_time' => "08:00:00",
                'close_time' => "22:00:00"
            ],
            [
                'id' => 29,
                'restaurant_id' => 6,
                'day' => "Tuesday",
                'open_time' => "08:00:00",
                'close_time' => "22:00:00"
            ],
            [
                'id' => 30,
                'restaurant_id' => 6,
                'day' => "Wednesday",
                'open_time' => "08:00:00",
                'close_time' => "22:00:00"
            ],
            [
                'id' => 31,
                'restaurant_id' => 6,
                'day' => "Thursday",
                'open_time' => "08:00:00",
                'close_time' => "22:00:00"
            ],
            [
                'id' => 32,
                'restaurant_id' => 6,
                'day' => "Friday",
                'open_time' => "08:00:00",
                'close_time' => "22:00:00"
            ],
            [
                'id' => 33,
                'restaurant_id' => 6,
                'day' => "Saturday",
                'open_time' => "09:00:00",
                'close_time' => "22:00:00"
            ],
            [
                'id' => 34,
                'restaurant_id' => 6,
                'day' => "Sunday",
                'open_time' => "10:00:00",
                'close_time' => "21:00:00"
            ],

            //Hyat
            [
                'id' => 35,
                'restaurant_id' => 7,
                'day' => "Monday",
                'open_time' => "08:00:00",
                'close_time' => "22:00:00"
            ],
            [
                'id' => 36,
                'restaurant_id' => 7,
                'day' => "Tuesday",
                'open_time' => "08:00:00",
                'close_time' => "22:00:00"
            ],
            [
                'id' => 37,
                'restaurant_id' => 7,
                'day' => "Wednesday",
                'open_time' => "08:00:00",
                'close_time' => "22:00:00"
            ],
            [
                'id' => 38,
                'restaurant_id' => 7,
                'day' => "Thursday",
                'open_time' => "08:00:00",
                'close_time' => "22:00:00"
            ],
            [
                'id' => 39,
                'restaurant_id' => 7,
                'day' => "Friday",
                'open_time' => "08:00:00",
                'close_time' => "22:00:00"
            ],
            [
                'id' => 40,
                'restaurant_id' => 7,
                'day' => "Saturday",
                'open_time' => "09:00:00",
                'close_time' => "22:00:00"
            ],
            [
                'id' => 41,
                'restaurant_id' => 7,
                'day' => "Sunday",
                'open_time' => "10:00:00",
                'close_time' => "21:00:00"
            ],

            //View
            [
                'id' => 42,
                'restaurant_id' => 8,
                'day' => "Monday",
                'open_time' => "08:00:00",
                'close_time' => "22:00:00"
            ],
            [
                'id' => 43,
                'restaurant_id' => 8,
                'day' => "Tuesday",
                'open_time' => "08:00:00",
                'close_time' => "22:00:00"
            ],
            [
                'id' => 44,
                'restaurant_id' => 8,
                'day' => "Wednesday",
                'open_time' => "08:00:00",
                'close_time' => "22:00:00"
            ],
            [
                'id' => 45,
                'restaurant_id' => 8,
                'day' => "Thursday",
                'open_time' => "08:00:00",
                'close_time' => "22:00:00"
            ],
            [
                'id' => 46,
                'restaurant_id' => 8,
                'day' => "Friday",
                'open_time' => "08:00:00",
                'close_time' => "22:00:00"
            ],
            [
                'id' => 47,
                'restaurant_id' => 8,
                'day' => "Saturday",
                'open_time' => "09:00:00",
                'close_time' => "22:00:00"
            ],
            [
                'id' => 48,
                'restaurant_id' => 8,
                'day' => "Sunday",
                'open_time' => "10:00:00",
                'close_time' => "21:00:00"
            ],

            //Justus
            [
                'id' => 49,
                'restaurant_id' => 9,
                'day' => "Monday",
                'open_time' => "08:00:00",
                'close_time' => "22:00:00"
            ],
            [
                'id' => 50,
                'restaurant_id' => 9,
                'day' => "Tuesday",
                'open_time' => "08:00:00",
                'close_time' => "22:00:00"
            ],
            [
                'id' => 51,
                'restaurant_id' => 9,
                'day' => "Thursday",
                'open_time' => "08:00:00",
                'close_time' => "22:00:00"
            ],
            [
                'id' => 52,
                'restaurant_id' => 9,
                'day' => "Friday",
                'open_time' => "08:00:00",
                'close_time' => "22:00:00"
            ],
            [
                'id' => 53,
                'restaurant_id' => 9,
                'day' => "Saturday",
                'open_time' => "09:00:00",
                'close_time' => "22:00:00"
            ],
            [
                'id' => 54,
                'restaurant_id' => 9,
                'day' => "Sunday",
                'open_time' => "10:00:00",
                'close_time' => "21:00:00"
            ],

            //Merah
            [
                'id' => 55,
                'restaurant_id' => 10,
                'day' => "Monday",
                'open_time' => "09:00:00",
                'close_time' => "22:00:00"
            ],
            [
                'id' => 56,
                'restaurant_id' => 10,
                'day' => "Tuesday",
                'open_time' => "09:00:00",
                'close_time' => "22:00:00"
            ],
            [
                'id' => 57,
                'restaurant_id' => 10,
                'day' => "Wednesday",
                'open_time' => "09:00:00",
                'close_time' => "22:00:00"
            ],
            [
                'id' => 58,
                'restaurant_id' => 10,
                'day' => "Thursday",
                'open_time' => "09:00:00",
                'close_time' => "22:00:00"
            ],
            [
                'id' => 59,
                'restaurant_id' => 10,
                'day' => "Friday",
                'open_time' => "09:00:00",
                'close_time' => "22:00:00"
            ],
            [
                'id' => 60,
                'restaurant_id' => 10,
                'day' => "Saturday",
                'open_time' => "09:00:00",
                'close_time' => "22:00:00"
            ],
            [
                'id' => 61,
                'restaurant_id' => 10,
                'day' => "Sunday",
                'open_time' => "10:00:00",
                'close_time' => "21:00:00"
            ],
        ]);
    }
}
