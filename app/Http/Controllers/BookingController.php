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
     * @param  Request id
     * @return \Illuminate\Http\Response
     */
    public function create(Request $id)
    {
        $user = User::find($id)->first();
        $place = Place::where('available', TRUE)
                      ->first();

        if ( empty($place) )
        {
            $user->joinRank();
            flash('You joined the waiting list, your position is '.$user->rank)->important();
        }else
        {
            Booking::create(['user_id' => $user->id, 'place_id' => $place->id]);
            $place->available = FALSE;
            $place->save();
            flash('You get the place number '.$place->id)->success()->important();
        }

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
     * @param  Request id
     * @return \Illuminate\Http\Response
     */
    public function cancel(Request $id)
    {
        $user = User::find($id)->first();

        if ( !empty($user->rank) )
        {
            $user->leaveRank();
            flash('Your place request was canceled.')->success()->important();
        }

        return redirect()->back();
    }
}
