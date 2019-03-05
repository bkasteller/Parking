<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->insert(

            array(
                array(
                    'id' => 1,
                    'validate' => TRUE,
                    'firstName' => 'Bryan',
                    'lastName' => 'KASTELLER',
                    'phoneNumber' => '0669056264',
                    'adress' => '23 rue du chêne',
                    'city' => 'Maurevert',
                    'zipCode' => '77390',
                    'email' => 'bryankasteller.10@gmail.com',
                    'password' => Hash::make('passwordbryan'),
                    'created_at' => '2019-02-14 00:00:00',
                    'updated_at' => '2019-02-14 00:00:00',
                    'activate' => TRUE,
                    'view' => TRUE,
                    'type' => 'admin'
                ),

                array(
                    'id' => 2,
                    'validate' => FALSE,
                    'firstName' => 'Regis',
                    'lastName' => 'GRUIMBERG',
                    'phoneNumber' => '0700000000',
                    'adress' => 'Madone',
                    'city' => 'Paris',
                    'zipCode' => '95018',
                    'email' => 'regis@gmail.com',
                    'password' => Hash::make('passwordregis'),
                    'created_at' => '2019-02-14 00:00:00',
                    'updated_at' => '2019-02-14 00:00:00',
                    'activate' => FALSE,
                    'view' => TRUE,
                    'type' => 'member'
                )
            )

        );
    }

}
