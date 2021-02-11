<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ProvincesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('provinces')->insert([
            [
                'province_web_address' => 'kabul',
                'province_name' => 'کابل',
                'province_image' => 'kabul.jpg'
            ],
            [
                'province_web_address' => 'herat',
                'province_name' => 'هرات',
                'province_image' => 'herat.jpg'
            ],
            [
                'province_web_address' => 'balkh',
                'province_name' => 'بلخ',
                'province_image' => 'balkh.jpg'
            ],
            [
                'province_web_address' => 'bamyan',
                'province_name' => 'بامیان',
                'province_image' => 'bamyan.jpg'
            ],
            [
                'province_web_address' => 'kandahar',
                'province_name' => 'کندهار',
                'province_image' => 'kandahar.jpg'
            ],
            [
                'province_web_address' => 'nangarhar',
                'province_name' => 'ننگرهار',
                'province_image' => 'nangarhar.jpg'
            ],
            
        ]);
    }
}
