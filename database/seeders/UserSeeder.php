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
                [ // 1
                    'name' =>  "admin",
                    'email' =>  "a@gmail.com",
                    'email_verified_at' =>  NULL,
                    'password' =>  Hash::make("12345678"),
                    'tlf' =>  "021445566",
                    'adresse' =>  "alger",
                    'role' =>  "admin",
                    'solde' =>  0,
                ],

                [ // 2
                    'name' =>  "oussama sadji",
                    'email' =>  "ou@gmail.com",
                    'email_verified_at' =>  NULL,
                    'password' =>  Hash::make("12345678"),
                    'tlf' =>  "071445166",
                    'adresse' =>  "alger",
                    'role' =>  "commercial",
                    'solde' =>  0,
                ],

                [ // 3
                    'name' =>  "younes bt5",
                    'email' =>  "y@gmail.com",
                    'email_verified_at' =>  NULL,
                    'password' =>  Hash::make("12345678"),
                    'tlf' =>  "071445166",
                    'adresse' =>  "alger",
                    'role' =>  "commercial",
                    'solde' =>  0,
                ],
                [ // 4
                    'name' =>  "biggy",
                    'email' =>  "b@gmail.com",
                    'email_verified_at' =>  NULL,
                    'password' =>  Hash::make("12345678"),
                    'tlf' =>  "055774566",
                    'adresse' =>  "sebala",
                    'role' =>  "commercial",
                    'solde' =>  0,
                ],
                [ // 5
                    'name' =>  "najib",
                    'email' =>  "n@gmail.com",
                    'email_verified_at' =>  NULL,
                    'password' =>  Hash::make("12345678"),
                    'tlf' =>  "055774566",
                    'adresse' =>  "sebala",
                    'role' =>  "prop_store",
                    'solde' =>  0,
                ],

                [ // 6
                    'name' =>  "achour",
                    'email' =>  "achour@gmail.com",
                    'email_verified_at' =>  NULL,
                    'password' =>  Hash::make("12345678"),
                    'tlf' =>  "055774566",
                    'adresse' =>  "achour",
                    'role' =>  "prop_store",
                    'solde' =>  0,
                ],
                [ // 7
                    'name' =>  "belfor",
                    'email' =>  "belfor@gmail.com",
                    'email_verified_at' =>  NULL,
                    'password' =>  Hash::make("12345678"),
                    'tlf' =>  "055774566",
                    'adresse' =>  "harache",
                    'role' =>  "prop_store",
                    'solde' =>  0,
                ],

            ]

        );
    }
}
