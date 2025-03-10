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
                    'nb_jr_garantie' =>  365,

                    'prix_g_tlf' =>  1300,
                    'prix_g_batterie' =>  800,
                    'prix_g_circuit' =>  700,

                    'double_puce' =>  1,
                    'actif' =>  1,
                ],

                [

                    'category_id' =>  1,
                    'brand_id' =>  1,
                    'product_name' =>  "S24 Ultra",
                    'nb_jr_garantie' =>  365,

                    'prix_g_tlf' =>  1500,
                    'prix_g_batterie' =>  1000,
                    'prix_g_circuit' =>  700,

                    'double_puce' =>  1,
                    'actif' =>  1,
                ],

                [

                    'category_id' =>  1,
                    'brand_id' =>  3,
                    'product_name' =>  "iphone 13pro",
                    'nb_jr_garantie' =>  365,

                    'prix_g_tlf' =>  1000,
                    'prix_g_batterie' =>  500,
                    'prix_g_circuit' =>  600,

                    'double_puce' =>  1,
                    'actif' =>  1,
                ],

                [

                    'category_id' =>  1,
                    'brand_id' =>  4,
                    'product_name' =>  "note 10 pro",
                    'nb_jr_garantie' =>  365,

                    'prix_g_tlf' =>  1500,
                    'prix_g_batterie' =>  500,
                    'prix_g_circuit' =>  600,
                    'double_puce' =>  1,
                    'actif' =>  1,
                ]
            ]

        );
    }
}
