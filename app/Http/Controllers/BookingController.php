<?php

namespace Parking\Http\Controllers;

use Illuminate\Http\Request;
use Parking\Booking;
use Auth;

class BookingController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @param  Place place
     * @return \Illuminate\Http\Response
     */
    public function create(Place $place)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Booking booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        //
    }
}
