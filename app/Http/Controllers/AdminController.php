<?php

namespace Parking\Http\Controllers;

use Illuminate\Http\Request;
use Parking\User;

class AdminController extends Controller
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

    public function index()
    {
        return view('admin');
    }

    public function searchUser(Request $request)
    {
        if ( empty(request('type')) )
            $type = 'member';
        else
            $type = request('type');

        if ( empty(request('activate')) )
            $activate = FALSE;
        else if ( request('activate') === 'TRUE' )
            $activate = TRUE;
        else
            $activate = FALSE;

        if ( empty(request('lastName')) && empty(request('firstName')) && empty(request('email')) )
            $users = User::query()
                         ->where('type', $type)
                         ->where('activate', $activate)
                         ->get();
        else
        {
            $users = User::query()
                   ->when(request()->has('lastName'), function($query) {
                        return $query->where('lastName', 'like', '%'. request('lastName') .'%');
                   })
                   ->when(request()->has('firstName'), function($query) {
                        return $query->where('firstName', 'like', '%'. request('firstName') .'%');
                   })
                   ->when(request()->has('email'), function($query) {
                        return $query->where('email', 'like', '%'. request('email') .'%');
                   })
                   ->get();

            $request->type = 'nothing';
            $request->activate = 'nothing';
        }

        return view('users', compact('request', 'users'));
    }

    public function activate(User $user)
    {
        if ( $user->activate )
            $user->activate = FALSE;
        else
            $user->activate = TRUE;

        $user->save();

        return redirect()->route('user.search');
    }
}
