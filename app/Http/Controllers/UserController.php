<?php

namespace Parking\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Parking\User;
use Auth;

class UserController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::where('id', Auth::user()->id)
                    ->first();

        if ( $user->isAdmin() )
            return view('admin');

        return view('user', compact('user'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showUpdatePassword()
    {
        return view('updatePassword');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => ['required', function ($attribute, $value, $fail) {
                              if ( !\Hash::check($value, Auth::user()->password) )
                                  return $fail(__('Invalid password.'));
                          }],
            'new_password' => ['required', 'string', 'min:6', 'max:255'],
            'new_password_confirmation' => ['required', 'same:new_password'],
        ]);

        Auth::user()->password = Hash::make(request('new_password'));
        Auth::user()->save();

        flash("Your password was successfully changed")->success()->important();

        return redirect('/user');
    }
}
