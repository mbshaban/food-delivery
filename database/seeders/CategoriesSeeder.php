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
                'title' => 'پیتزا',
                'category_image' => 'ddd'
            ],
            [
                'title' => 'آشک',
                'category_image' => 'ddd'

            ],
            [
                'title' => 'بولانی',
                'category_image' => 'ddd'

            ],
            [
                'title' => 'قابلی',
                'category_image' => 'ddd'

            ]
        ]);
    }
}
