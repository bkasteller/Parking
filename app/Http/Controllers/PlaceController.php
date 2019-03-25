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
        return view('editPlace', compact('place'));
    }

    /**
     * Make available or unavailable a place.
     *
     * @param  Place place
     * @return \Illuminate\Http\Response
     */
    public function update(Place $place)
    {
        if ( $place->occupied() )
            flash('You have closed the <B>Place N°'.$place->id.'</B> but they have an user assigned to this place.
                  <br>If you don\'t stop this booking, the user can carry on to use this place.')->warning()->important();

        $place->available = !$place->available;
        $place->save();

        return redirect()->back();
    }
}
