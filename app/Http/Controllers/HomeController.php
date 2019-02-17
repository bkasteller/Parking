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
        $myPlaces = $this->recoverMyPlaces();

        if ( !empty($myPlaces[0]) )
        {
            if ( empty(request('assign')) )
                $myPlace = $myPlaces->first();
            else
                $myPlace = $myPlaces
                         ->where('assign_id', request('assign'))
                         ->first();

            $myPlace = $this->expired($myPlace);
        } else
            $myPlace = '';

        return view('home', [
            'byRequest' => request('assign'),
            'myPlaces' => $myPlaces,
            'myPlace' => $myPlace,
        ]);
    }

    /**
     *
     */
    public function recoverMyPlaces()
    {
        return DB::table('users')
                 ->join('assign', 'assign.user_id', '=', 'users.id')
                 ->join('parkingPlaces', 'parkingPlaces.id', '=', 'assign.parkingPlaces_id')
                 ->join('date', 'date.id', '=', 'assign.date_id')
                 ->select('parkingPlaces.id', 'assign.id AS assign_id', 'duration', 'date.created_at')
                 ->where('users.id', Auth::user()->id)
                 ->orderBy('created_at', 'desc')
                 ->get();
    }

    /**
     *
     */
    public function expired($myPlace)
    {
        $duration = $myPlace->duration;
        $now = date("Y-m-d");
        $start = date("Y-m-d", strtotime($myPlace->created_at));
        $end = date("Y-m-d", strtotime($start." +".$duration." days"));
        $days = (strtotime($end) - strtotime($now)) / 86400;

        return [
            'attributes' => $myPlace,
            'start' => $start,
            'duration' => $duration,
            'now' => $now,
            'end' => $end,
            'days' => $days,
        ];
    }
}
