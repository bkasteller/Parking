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
     * Display the specified resource.
     *
     * @param  Booking booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        $user = Auth::user();
        $condition = Booking::where('id', $booking->id)
                            ->where('user_id', $user->id)
                            ->first();

        if ( $user->isAdmin() || exist($condition) )
            return view('showBooking', compact('booking'));

        return redirect()->back();
    }

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
            $user->joinRank();
            placeFinder();
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

        if ( $user->cancel_rank() )
            flash('Your place request was canceled.')->success()->important();

        if ( $user->cancel_place() )
            flash('Your place as been removed.')->success()->important();

        return redirect()->back();
    }
}
