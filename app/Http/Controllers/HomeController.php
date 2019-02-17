<?php

namespace Parking\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home', [
            'myPlace' => $this->recoverMyPlace(),
        ]);
    }

    /**
     * This function return the la place assigned to the current user
     */
    public function recoverMyPlace()
    {
        $myPlaces = DB::table('users')
                    ->join('assign', 'assign.user_id', '=', 'users.id')
                    ->join('parkingPlaces', 'parkingPlaces.id', '=', 'assign.parkingPlaces_id')
                    ->join('date', 'date.id', '=', 'assign.date_id')
                    ->select('parkingPlaces.id', 'assign.id AS assign_id', 'duration', 'date.created_at')
                    ->where('users.id', Auth::user()->id)
                    ->orderBy('date.created_at', 'desc')
                    ->get();

        return  $this->expired($myPlaces);
    }

    public function expired($myPlaces)
    {
        $latestPlace = $myPlaces->first();
        $duration = $latestPlace->duration;
        $now = date("Y-m-d");
        $start = date("Y-m-d", strtotime($latestPlace->created_at));
        $end = date("Y-m-d", strtotime($start." +".$duration." days"));
        $days = (strtotime($end) - strtotime($now)) / 86400;

        if ( $days < 0 )
          $days = 'expirated';

        return [
            'oldPlaces' => $myPlaces,
            'attribute' => $latestPlace,
            'start' => $start,
            'duration' => $duration,
            'now' => $now,
            'end' => $end,
            'days' => $days,
        ];
    }
}
