<?php

namespace Parking\Http\Controllers;

use Illuminate\Http\Request;
use Parking\Place;

class PlaceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a group or single users.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $places = Place::get();

        return view('searchPlace', compact('places'));
    }

    /**
    * Create a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        Place::create();

        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Place place
     * @return \Illuminate\Http\Response
     */
    public function edit(Place $place)
    {
        if ( occupied($place) )
        {
            $booking = place_booking($place);
            $user = place_user($place);
        }else
            $booking = $user = '';

        return view('editPlace', compact('place', 'booking', 'user'));
    }

    /**
     *
     *
     * @param  Place place
     * @return \Illuminate\Http\Response
     */
    public function update(Place $place)
    {
        $place->available ? $place->available = FALSE : $place->available = TRUE;
        $place->save();

        return redirect()->back();
    }

    /**
     * Make available or unavailable a place.
     *
     * @param  Place place
     * @return \Illuminate\Http\Response
     */
    public function available(Place $place)
    {
        $place->available = !$place->available;
        $place->save();

        return redirect()->back();
    }
}
