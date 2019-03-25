<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->insert(
            array(
                'id' => 1,
                'first_name' => 'Bryan',
                'last_name' => 'KASTELLER',
                'phone_number' => '0669056264',
                'address' => '23 rue du chêne',
                'city' => 'Maurevert',
                'postal_code' => '77390',
                'email' => 'bryan@gmail.com',
                'password' => Hash::make('passwordbryan'),
                'created_at' => '2019-02-14 00:00:00',
                'updated_at' => '2019-02-14 00:00:00',
                'activate' => TRUE,
                'type' => 'admin',
                'rank' => NULL
            )
        );
    }

}
