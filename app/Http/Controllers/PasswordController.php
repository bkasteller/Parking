<?php

namespace Parking\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Auth;

class PasswordController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('editPassword');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Request request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
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

        return redirect()->route('home');
    }
}
