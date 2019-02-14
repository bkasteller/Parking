<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssignTableSeeder extends Seeder {

    public function run()
    {
        DB::table('assign')->insert(

            array(
                array(
                    'id' => 1,
                    'duration' => 7,
                    'user_id' => 1,
                    'date_id' => 1,
                    'parkingPlaces_id' => 2
                )
            )

        );
    }

}
