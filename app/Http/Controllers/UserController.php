<?php

namespace Parking\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Parking\User;
use Auth;
use Illuminate\Validation\Rule;

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
        $user = Auth::user();

        return view('user', compact('user'));
    }

    /**
     * Display a group or single users.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
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
               ->when(request()->has('type'), function($query) {
                    return $query->where('type', request('type'));
               })
               ->when(request()->has('activate'), function($query) {
                    return $query->where('activate', request('activate') === 't' ? TRUE : FALSE);
               })
               ->get();

               $get_back = $request->all();

        return view('searchUser', compact('users', 'get_back'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view('showUser', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        dd('test');
        $request->validate([
            'lastName' => ['required', 'string', 'max:255'],
            'firstName' => ['required', 'string', 'max:255'],
            'phoneNumber' => ['required', 'numeric', 'digits:10'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'zipCode' => ['required', 'string', 'digits:5'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => ['nullable', 'string', 'min:6', 'max:255', 'confirmed'],
        ]);

        $user->update($request->except('password', 'password_confirmation'));

        flash("User ($user->lastName $user->firstName) updated successfully.")->success()->important();

        return redirect()->back();
    }

    /**
     * Activate or deactivate a user.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function activate(User $user)
    {
        $user->activate ? $user->activate = FALSE : $user->activate = TRUE;
        $user->save();

        return redirect()->route('user.index');
    }
}
