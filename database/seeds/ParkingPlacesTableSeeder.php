<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParkingPlacesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('parkingPlaces')->insert(

            array(
                array(
                    'id' => 1,
                    'status' => TRUE,
                    'created_at' => '2019-02-14 00:00:00',
                    'updated_at' => '2019-02-14 00:00:00'
                ),

                array(
                    'id' => 2,
                    'status' => TRUE,
                    'created_at' => '2019-02-14 00:00:00',
                    'updated_at' => '2019-02-14 00:00:00'
                ),

                array(
                    'id' => 3,
                    'status' => FALSE,
                    'created_at' => '2019-02-14 00:00:00',
                    'updated_at' => '2019-02-14 00:00:00'
                )
            )

        );
    }

}
