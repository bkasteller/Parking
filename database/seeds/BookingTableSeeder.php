<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bookings')->insert(
            array(
                'id' => 1,
                'duration' => NULL,
                'created_at' => '2019-03-12',
                'updated_at' => '2019-03-12',
                'user_id' => 1,
                'place_id' => 1
            )
        );
    }
}
