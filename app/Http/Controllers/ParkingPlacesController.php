<?php

namespace Parking\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ParkingPlacesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parkingPlaces = DB::table('parkingPlaces')
                       ->get();

        return view('parkingPlaces', [
            'parkingPlaces' => $parkingPlaces,
        ]);
    }
}
