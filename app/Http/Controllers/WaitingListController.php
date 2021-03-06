<?php

namespace Parking\Http\Controllers;

use Illuminate\Http\Request;
use Parking\User;

class WaitingListController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $users = User::whereNotNull('rank')->orderBy('rank', 'asc')->get();

        return view('editWaitingList', compact('users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = User::where('rank', request('last_rank'))->first();
        $rank = request('new_rank');

        if ( exist($user) )
            $user->updateRank($rank);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->leaveRank();

        return redirect()->back();
    }
}
