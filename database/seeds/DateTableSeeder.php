<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DateTableSeeder extends Seeder {

    public function run()
    {
        DB::table('date')->insert(

            array(
                array(
                    'id' => 1,
                    'created_at' => '2019-02-12 00:00:00',
                    'updated_at' => '2019-02-12 00:00:00'
                ),

                array(
                    'id' => 2,
                    'created_at' => '2019-02-13 00:00:00',
                    'updated_at' => '2019-02-13 00:00:00'
                ),

                array(
                    'id' => 3,
                    'created_at' => '2019-02-14 00:00:00',
                    'updated_at' => '2019-02-14 00:00:00'
                )
            )

        );
    }

}
