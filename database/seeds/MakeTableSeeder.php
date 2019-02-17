<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MakeTableSeeder extends Seeder {

    public function run()
    {
        DB::table('make')->insert(

            array(
                array(
                    'id' => 1,
                    'user_id' => 1,
                    'request_id' => 1
                ),

                array(
                    'id' => 2,
                    'user_id' => 1,
                    'request_id' => 2
                ),

                array(
                    'id' => 3,
                    'user_id' => 1,
                    'request_id' => 3
                )
            )

        );
    }

}
