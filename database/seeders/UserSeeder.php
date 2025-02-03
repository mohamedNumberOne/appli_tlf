<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        DB::table('users')->insert(
            [
                [
                    'name' =>  "admin",
                    'email' =>  "a@gmail.com",
                    'email_verified_at' =>  NULL,
                    'password' =>  Hash::make("12345678"),
                    'tlf' =>  "021445566",
                    'adresse' =>  "alger",
                    'role' =>  "admin",
                    'solde' =>  0,
                ],

                [
                    'name' =>  "oussama sadji",
                    'email' =>  "ou@gmail.com",
                    'email_verified_at' =>  NULL,
                    'password' =>  Hash::make("12345678"),
                    'tlf' =>  "071445166",
                    'adresse' =>  "alger",
                    'role' =>  "commercial",
                    'solde' =>  0,
                ],
                [
                    'name' =>  "Samsung",
                    'email' =>  "p@gmail.com",
                    'email_verified_at' =>  NULL,
                    'password' =>  Hash::make("12345678"),
                    'tlf' =>  "055774566",
                    'adresse' =>  "bjaya",
                    'role' =>  "prop_store",
                    'solde' =>  0,
                ],

            ]

        );
    }
}
