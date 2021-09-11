<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SellerStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('seller_status')->insert([
            [
                'text' => 'باز می باشد',
                'slug' => 'open'
            ],
            [
                'text' => 'موقتا غیر فعال می باشد',
                'slug' => 'temp_close'
            ],
            [
                'text' => ' غیر فعال می باشد',
                'slug' => 'close'
            ],

        ]);
    }
}
