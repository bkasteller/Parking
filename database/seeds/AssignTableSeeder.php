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
                    'duration' => 1,
                    'user_id' => 1,
                    'date_id' => 1,
                    'parkingPlaces_id' => 2
                ),

                array(
                    'id' => 2,
                    'duration' => 1,
                    'user_id' => 1,
                    'date_id' => 2,
                    'parkingPlaces_id' => 1
                ),

                array(
                    'id' => 3,
                    'duration' => 8,
                    'user_id' => 1,
                    'date_id' => 3,
                    'parkingPlaces_id' => 2
                )
            )

        );
    }

}
