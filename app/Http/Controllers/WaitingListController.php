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
     * @param  User user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $rank = request('rank');
        $user->leaveRank();
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
