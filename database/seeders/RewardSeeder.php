<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RewardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rewards')->insert([
            [
                'id' => 1,
                'name' => "Tokopedia Give Card 10K",
                'description' => "Redeem this voucher for 10K Gopay Coins on Tokopedia. Valid for 12 months from date of issue.",
                'points' => 10000,
                'category' => "Tokopedia",
                'image' => "reward/imageGiftCardTokped.png",
                'stock' => 20,
                'is_active' => true,
            ],
            [
                'id' => 2,
                'name' => "Tokopedia Give Card 50K",
                'description' => "Redeem this voucher for 50K Gopay Coins on Tokopedia. Valid for 12 months from date of issue.",
                'points' => 50000,
                'category' => "Tokopedia",
                'image' => "reward/imageGiftCardTokped.png",
                'stock' => 20,
                'is_active' => true,
            ],
            [
                'id' => 3,
                'name' => "Indomaret Give Card 10K",
                'description' => "Redeem this voucher for 10K Discount in Indomaret. Valid for 12 months from date of issue.",
                'points' => 10000,
                'category' => "Indomaret",
                'image' => "reward/idm10k.png",
                'stock' => 10,
                'is_active' => true,
            ],
            [
                'id' => 4,
                'name' => "Alfamart Give Card 10K",
                'description' => "Redeem this voucher for 10K Discount in Alfamart. Valid for 12 months from date of issue.",
                'points' => 10000,
                'category' => "Alfamart",
                'image' => "reward/alfa10k.png",
                'stock' => 15,
                'is_active' => true,
            ],
            [
                'id' => 5,
                'name' => "Tokopedia Give Card 100K",
                'description' => "Redeem this voucher for 100K Gopay Coins on Tokopedia. Valid for 12 months from date of issue.",
                'points' => 100000,
                'category' => "Tokopedia",
                'image' => "reward/imageGiftCardTokped.png",
                'stock' => 5,
                'is_active' => true,
            ],
            [
                'id' => 6,
                'name' => "Indomaret Give Card 100K",
                'description' => "Redeem this voucher for 100K Discount in Indomaret. Valid for 12 months from date of issue.",
                'points' => 100000,
                'category' => "Indomaret",
                'image' => "reward/idm100k.png",
                'stock' => 6,
                'is_active' => true,
            ],
            [
                'id' => 7,
                'name' => "Alfamart Give Card 100K",
                'description' => "Redeem this voucher for 100K Discount in Alfamart. Valid for 12 months from date of issue.",
                'points' => 100000,
                'category' => "Alfamart",
                'image' => "reward/alfa100k.png",
                'stock' => 10,
                'is_active' => true,
            ],
        ]);
    }
}
