<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RequestsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('requests')->insert(

            array(
                array(
                    'id' => 1,
                    'rank' => NULL,
                    'created_at' => '2019-02-14 00:00:00',
                    'updated_at' => '2019-02-14 00:00:00'
                )
            )

        );
    }

}
