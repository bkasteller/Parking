<?php

namespace Parking\Http\Controllers;

use Illuminate\Http\Request;
use Parking\Booking;
use Parking\User;
use Parking\Place;
use Auth;

class BookingController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();

        if ( !exist($user->place()) )
        {
            $place = Place::where('available', TRUE)
                          ->first();

            if ( empty($place) )
            {
                $user->joinRank();
                flash('You joined the waiting list, your position is '.$user->rank)->important();
            }else
            {
                Booking::create(['user_id' => $user->id, 'place_id' => $place->id]);
                $place->save();
                flash('You get the place number '.$place->id)->success()->important();
            }
        }else
            flash('You already have a place.')->error()->important();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Booking booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        $booking->abort();

        return redirect()->back();
    }

    /**
     * If the user is waiting to get a place, leave the waiting list.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancel()
    {
        $user = Auth::user();

        if ( exist($user->rank) )
        {
            $user->leaveRank();
            flash('Your place request was canceled.')->success()->important();
        }else if ( exist($user->place()) )
        {
            $user->booking()->abort();
            flash('Your place as been removed.')->success()->important();
        }

        return redirect()->back();
    }
}
