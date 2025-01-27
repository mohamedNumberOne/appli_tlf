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







DB::table('products')->insert([

            'category_id' =>  1,
            'brand_id' =>  1,
            'product_name' =>  "S24 Ultra",
            'prix_garantie' =>  1500  ,
            'nb_jr_garantie' =>  365,
            'double_puce' =>  1,
            'actif' =>  1,
        ]);
    }
}
