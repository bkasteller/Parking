<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->insert(
            array(
                'id' => 1,
                'firstName' => 'Bryan',
                'lastName' => 'KASTELLER',
                'phoneNumber' => '0669056264',
                'adress' => '23 rue du chêne',
                'city' => 'Maurevert',
                'zipCode' => '77390',
                'email' => 'bryan@gmail.com',
                'password' => Hash::make('passwordbryan'),
                'created_at' => '2019-02-14 00:00:00',
                'updated_at' => '2019-02-14 00:00:00',
                'activate' => TRUE,
                'view' => TRUE,
                'type' => 'admin'
            )
        );
    }

}
