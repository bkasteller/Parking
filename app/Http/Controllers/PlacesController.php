<?php

namespace Parking\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Parking\Place;

class PlacesController extends Controller
{
    public function index()
    {
        $places = DB::table('places')
                       ->get();

        return view('places', [
            'places' => $places,
        ]);
    }

    public function add()
    {
        Place::create();

        return redirect('places');
    }

    public function describe(Place $place)
    {
        return view('place', compact('place'));
    }
}
