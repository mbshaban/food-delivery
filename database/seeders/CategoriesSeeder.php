<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'type' => 'Resturant',
                'category_webaddress' => 'piza',
                'category_name' => 'پیتزا',
                'category_image' => 'piza.jpg',
                'category_description' => 'پیتزا یکی از بهترین غذاهای جهان است'
            ],
            [
                'type' => 'Resturant',
                'category_webaddress' => 'Ashak',
                'category_name' => 'آشک',
                'category_image' => 'ashak.jpg',
                'category_description' => 'آشک یکی از بهترین غذاهای جهان است'
            ],
            [
                'type' => 'Resturant',
                'category_webaddress' => 'bolani',
                'category_name' => 'بولانی',
                'category_image' => 'bolani.jpg',
                'category_description' => 'بولانی یکی از بهترین غذاهای جهان است'
            ],
            [
                'type' => 'Resturant',
                'category_webaddress' => 'qabili',
                'category_name' => 'قابلی',
                'category_image' => 'qabili.jpg',
                'category_description' => 'قابلی یکی از بهترین غذاهای جهان است'
            ]
        ]);
    }
}
