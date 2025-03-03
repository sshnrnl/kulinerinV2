<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Faker\Factory as Faker;


class RatingRestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('ratting_restaurants')->insert([

        // ]);

        // if (Schema::hasTable('rating_restaurants')) {
        //     $faker = Faker::create();
        //     $restaurantIds = DB::table('restaurants')->pluck('id')->toArray();

        //     if (!empty($restaurantIds)) {
        //         foreach ($restaurantIds as $restaurantId) {
        //             for ($i = 0; $i < 10; $i++) {
        //                 DB::table('rating_restaurants')->insert([
        //                     'restaurant_id' => $restaurantId,
        //                     'score' => (string) rand(1, 5),
        //                     'review' => $faker->sentence(),
        //                     'created_at' => now(),
        //                     'updated_at' => now(),
        //                 ]);
        //             }
        //         }
        //     }
        // }

        // if (Schema::hasTable('rating_restaurants')) {
        //     $faker = Faker::create();
        //     $restaurantIds = DB::table('restaurants')->pluck('id')->toArray();
        //     $userIds = DB::table('users')->pluck('id')->toArray();

        //     if (!empty($restaurantIds) && !empty($userIds)) {
        //         foreach ($restaurantIds as $restaurantId) {
        //             for ($i = 0; $i < 10; $i++) {
        //                 DB::table('rating_restaurants')->insert([
        //                     'restaurant_id' => $restaurantId,
        //                     'user_id' => $faker->randomElement($userIds),
        //                     'score' => (string) rand(4, 5),
        //                     'review' => $faker->sentence(),
        //                     'created_at' => now(),
        //                     'updated_at' => now(),
        //                 ]);
        //             }
        //         }
        //     }
        // }
    }
}
