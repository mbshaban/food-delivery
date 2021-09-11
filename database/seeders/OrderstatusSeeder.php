<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class OrderstatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_status')->insert([
            [
                'order_status' => 'pending'
            ],
            [
                'order_status' => 'approved'
            ],
            [
                'order_status' => 'under process'
            ],
            [
                'order_status' => 'on the way'
            ],

        ]);
    }
}
