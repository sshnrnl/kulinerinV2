<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $userIds = DB::table('users')->where('role', 2)->pluck('id')->toArray();

        if (empty($userIds)) {
            $this->command->warn("No users with role 2 found. Skipping restaurant seeding.");
            return;
        }

        DB::table('restaurants')->insert([
            [
                'id' => 1,
                'user_id' => 51,
                'restaurantName' => "Lawry's The Prime Rib Jakarta",
                'restaurantPhoneNumber' => "0812666666001",
                'restaurantCity' => "South Jakarta",
                'restaurantAddress' => "Jl. Bumi No.15, RT.3/RW.2, Gunung, Kec. Kby. Baru, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12120",
                'restaurantDescription' => "Lawry's The Prime Rib Jakarta offers a fine dining experience with signature prime rib served with traditional sides, complemented by an exquisite selection of wines.",
                'restaurantStyle' => "Western",
                'restaurantImage' => "restaurant/lawry.jpg, restaurant/lawry1.jpg, restaurant/lawry1.jpg"
            ],
            [
                'id' => 2,
                'user_id' => 52,
                'restaurantName' => "Anigre - Sheraton Grand Jakarta Gandaria City Hotel",
                'restaurantPhoneNumber' => "081234567890",
                'restaurantCity' => "South Jakarta",
                'restaurantAddress' => "l. Sultan Iskandar Muda, Kby. Lama Utara, Kec. Kby. Lama, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12240",
                'restaurantDescription' => "Sheraton Grand Jakarta Gandaria City Hotel offers a welcoming all-day buffet restaurant with delicious cuisine, as well as a stylish lobby bar.",
                'restaurantStyle' => "Western",
                'restaurantImage' => "restaurant/anigre.jpg, restaurant/anigre1.jpg, restaurant/anigre2.jpg"
            ],
            [
                'id' => 9,
                'user_id' => 53,
                'restaurantName' => "Justus Steakhouse Alam Sutera",
                'restaurantPhoneNumber' => "0812666666002",
                'restaurantCity' => "South Tangerang",
                'restaurantAddress' => "Jl. Alam Sutera Town Center, Jl. Alam Utama Blok 10J No.6, Pakulonan, Kec. Serpong Utara, Kota Tangerang Selatan, Banten 15325",
                'restaurantDescription' => "Justus Group is home to several restaurant brands, each offering the finest quality and specially curated dishes. From burgers and steaks to authentic Indonesian cuisine rich in distinctive flavors and a blend of traditional spices, Justus Group ensures an exceptional dining experience for all tastes",
                'restaurantStyle' => "Western",
                'restaurantImage' => "restaurant/justus.jpg, restaurant/justus1.jpg, restaurant/justus2.jpg"
            ],
            // [
            //     'id' => 4,
            //     'restaurantName' => "Sushi Tei",
            //     'restaurantPhoneNumber' => "0812666666003",
            //     'restaurantCity' => "Jakarta",
            //     'restaurantAddress' => "Plaza Indonesia, Jakarta, Indonesia",
            //     'restaurantDescription' => "Sushi Tei offers fresh and authentic Japanese sushi, sashimi, and a wide variety of Japanese dishes with excellent service.",
            //     'restaurantStyle' => "Casual Dining, Japanese",
            //     'restaurantImage' => "imageRestaurant4.jpg"
            // ],
            [
                'id' => 5,
                'user_id' => 54,
                'restaurantName' => "BLANCO Par Mandif",
                'restaurantPhoneNumber' => "0812666666004",
                'restaurantCity' => "Kabupaten Gianyar",
                'restaurantAddress' => "Kompleks Museum Blanco, Jl. Raya Tjampuhan, Ubud, Sayan, Kec. Gianyar, Kabupaten Gianyar, Bali 80571",
                'restaurantDescription' => "BLANCO Par Mandif is an exclusive fine dining restaurant located in Ubud, Bali, offering a sophisticated culinary experience that blends traditional Indonesian flavors with modern techniques.",
                'restaurantStyle' => "Asian",
                'restaurantImage' => "restaurant/blanco.jpg, restaurant/blanco1.jpg, restaurant/blanco.jpeg"
            ],
            [
                'id' => 6,
                'user_id' => 55,
                'restaurantName' => "The 1945 Restaurant",
                'restaurantPhoneNumber' => "0812666666005",
                'restaurantCity' => "Central Jakarta",
                'restaurantAddress' => "Jl. Asia Afrika No.8, Gelora, Kecamatan Tanah Abang, Jakarta, Daerah Khusus Ibukota Jakarta 10270",
                'restaurantDescription' => "The 1945 Restaurant is a luxurious dining destination located at the Fairmont Jakarta, offering a sophisticated blend of classic and contemporary Indonesian cuisine. Inspired by Indonesia’s rich history and heritage, the restaurant's name pays homage to the year of Indonesia's independence, creating a connection to the nation's past while celebrating its culinary diversity.",
                'restaurantStyle' => "Asian",
                'restaurantImage' => "restaurant/1945restaurant.jpg, restaurant/1945restaurant1.jpg, restaurant/1945restaurant2.jpg"
            ],
            [
                'id' => 7,
                'user_id' => 56,
                'restaurantName' => "The Grand Hyatt Jakarta",
                'restaurantPhoneNumber' => "0812666666006",
                'restaurantCity' => "Central Jakarta",
                'restaurantAddress' => "Jl. M.H. Thamrin No.Kav. 28-30, Gondangdia, Kec. Menteng, Jakarta, Daerah Khusus Ibukota Jakarta 10350",
                'restaurantDescription' => "The Grand Hyatt Jakarta offers a luxurious dining experience with a range of fine cuisine including Indonesian, Chinese, and International options.",
                'restaurantStyle' => "Western",
                'restaurantImage' => "restaurant/hyat.jpg, restaurant/hyat1.jpg, restaurant/hyat2.jpg"
            ],
            [
                'id' => 8,
                'user_id' => 57,
                'restaurantName' => "View Restaurant & Bar",
                'restaurantPhoneNumber' => "0812666666007",
                'restaurantCity' => "Yogyakarta",
                'restaurantAddress' => "Fairmont Jakarta, Jl. Asia Afrika No.8, Gelora, Kecamatan Tanah Abang, Jakarta, Daerah Khusus Ibukota Jakarta 10270",
                'restaurantDescription' => "View at Fairmont Jakarta offers an extraordinary dining experience that combines stunning city views with exquisite cuisine. Located on the top floor of the Fairmont Jakarta, this sophisticated restaurant provides panoramic views of the Jakarta skyline, creating an ideal setting for a memorable meal.",
                'restaurantStyle' => "Bar",
                'restaurantImage' => "restaurant/view.jpeg, restaurant/view.jpg, restaurant/view1.jpg"
            ],
            [
                'id' => 3,
                'user_id' => 58,
                'restaurantName' => "Nusa Indonesian Gastronomy",
                'restaurantPhoneNumber' => "0812666666008",
                'restaurantCity' => "South Jakarta",
                'restaurantAddress' => "Jl. Kemang Sel. No.81, Bangka, Kemang, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12730",
                'restaurantDescription' => "Nusa Indonesian Gastronomy is a distinguished fine dining restaurant in Jakarta, dedicated to showcasing the rich and diverse flavors of Indonesia through a modern culinary lens. The restaurant prides itself on offering a unique gastronomic experience that highlights Indonesia’s vast cultural and regional culinary heritage, with each dish expertly crafted to bring out the authentic taste of the islands.",
                'restaurantStyle' => "Fine Dining",
                'restaurantImage' => "restaurant/nusa.jpg, restaurant/nusa1.jpg, restaurant/nusa2.jpg"
            ],
            [
                'id' => 10,
                'user_id' => 59,
                'restaurantName' => "Merah Putih Restaurant",
                'restaurantPhoneNumber' => "0812666666009",
                'restaurantCity' => "West Jakarta",
                'restaurantAddress' => "Jl. Sang Timur No.71 2, RT.12/RW.4, Kb. Jeruk, Kec. Kb. Jeruk, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11530",
                'restaurantDescription' => "Merah Putih Restaurant is an upscale dining destination located in Seminyak, Bali, renowned for its innovative take on traditional Indonesian cuisine. The name Merah Putih, meaning Red and White, is inspired by the colors of Indonesia's national flag, symbolizing the restaurant's dedication to celebrating Indonesia's rich culinary heritage.",
                'restaurantStyle' => "Asian",
                'restaurantImage' => "restaurant/merah.jpg, restaurant/merah1.jpg, restaurant/merah2.jpg"
            ]
        ]);
    }
}
