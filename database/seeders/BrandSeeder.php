<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('brands')->insert(

            [

                [
                    "id" =>  1,
                    'brand_name' =>  "Samsung",

                ],
                [
                    "id" =>  2,
                    'brand_name' =>  "Oppo",

                ],
                [
                    "id" =>  3,
                    'brand_name' =>  "Apple",

                ],
                [
                    "id" => 4,
                    'brand_name' =>  "Redmi",

                ]
            ]

        );
    }
}
