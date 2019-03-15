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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $places = Places::get();

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

        return redirect()->route('place.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Place place
     * @return \Illuminate\Http\Response
     */
    public function edit(Place $place)
    {
        return view('place', compact('place'));
    }

    /**
     * Make available or unavailable a place.
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
        $place->available ? $place->available = FALSE : $place->available = TRUE;
        $place->save();

        return redirect()->back();
    }
}
