<?php

namespace Parking\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Parking\User;

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
    public function index(User $user)
    {
        $myPlaces = $this->recoverMyPlaces($user);

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

    public function recoverMyPlaces($user)
    {
        return $user->places;
    }
}
