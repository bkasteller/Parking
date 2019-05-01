<?php

namespace Parking\Http\Controllers;

use Illuminate\Http\Request;
use Parking\Place;

class PlaceController extends Controller
{
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
        $bookings = $place->bookings->sortBy('created_at')->reverse();

        return view('editPlace', compact('place', 'bookings'));
    }

    /**
     * Make available or unavailable a place.
     *
     * @param  Place place
     * @return \Illuminate\Http\Response
     */
    public function update(Place $place)
    {
        $place->available();

        return redirect()->back();
    }
}
