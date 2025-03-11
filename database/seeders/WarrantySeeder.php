<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WarrantySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('warranties')->insert(
            [

                [
                    'nom_garantie' =>  "Telephone",
                ],
                [
                    'nom_garantie' =>  "Batterie",
                ],

                [
                    'nom_garantie' =>  "Circuit de charge",
                ],
            ]
        );
    }
}
