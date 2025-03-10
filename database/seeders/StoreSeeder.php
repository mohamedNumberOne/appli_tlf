<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('stores')->insert(
            [
                "store_name"  =>  "stan phone" ,
                "id_added_by_com"  =>  3 ,
                "id_prop"  =>  5 ,
                "total_to_pay"  =>  0 ,

            ],
            [
                "store_name"  =>  "belfor store  ",
                "id_added_by_com"  =>  4 ,
                "id_prop"  =>  7,
                "total_to_pay"  =>  0,
            ],

            [
                "store_name"  =>  "achour store ",
                "id_added_by_com"  =>  4,
                "id_prop"  =>  6,
                "total_to_pay"  =>  0,
            ],

        );
    }
}
