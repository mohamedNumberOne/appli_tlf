<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        DB::table('products')->insert(

            [
                [

                    'category_id' =>  1,
                    'brand_id' =>  2,
                    'product_name' =>  "oppo f41",
                    'prix_garantie' =>  1000,
                    'nb_jr_garantie' =>  365,
                    'double_puce' =>  1,
                    'actif' =>  1,
                ],

                [

                    'category_id' =>  1,
                    'brand_id' =>  1,
                    'product_name' =>  "S24 Ultra",
                    'prix_garantie' =>  1500,
                    'nb_jr_garantie' =>  365,
                    'double_puce' =>  1,
                    'actif' =>  1,
                ],

                [

                    'category_id' =>  1,
                    'brand_id' =>  3,
                    'product_name' =>  "iphone 13pro",
                    'prix_garantie' =>  2000,
                    'nb_jr_garantie' =>  365,
                    'double_puce' =>  1,
                    'actif' =>  1,
                ],

                [

                    'category_id' =>  1,
                    'brand_id' =>  4,
                    'product_name' =>  "note 10 pro",
                    'prix_garantie' =>  2000,
                    'nb_jr_garantie' =>  30,
                    'double_puce' =>  1,
                    'actif' =>  1,
                ]
            ]

        );
    }
}
