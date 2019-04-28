<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlaceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('places')->insert(
            array(
                array(
                    'id' => 1,
                    'wording' => "1",
                    'available' => TRUE
                ),

                array(
                    'id' => 2,
                    'wording' => "2",
                    'available' => FALSE
                ),

                array(
                    'id' => 3,
                    'wording' => 3,
                    'available' => TRUE
                )
            )
        );
    }
}
