<?php

namespace Parking\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Auth;

class ChangePasswordController extends Controller
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
        return view('changePassword');
    }

    /**
     * Update the password for the user
     */
    public function change()
    {
        request()->validate([
            'password' => ['required', function ($attribute, $value, $fail)  {
                              if (!\Hash::check($value, Auth::user()->password)) {
                                  return $fail(__('Invalid password.'));
                              }
                          }],
            'new_password' => ['required', 'string', 'min:6', 'max:255'],
            'new_password_confirmation' => ['required', 'same:new_password'],
        ]);

        flash("Your password was successfully changed")->success()->important();

        Auth::user()->password = Hash::make(request('new_password'));
        Auth::user()->save();

        return redirect('/home');
    }
}
