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
    public function index(Request $request)
    {
        $user = Auth::user();

        return view('home', compact('user'));
    }

    /**
     * Display a group or single users.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $users = User::query()
               ->when(request()->has('last_name'), function($query) {
                    return $query->where('last_name', 'like', '%'. request('last_name') .'%');
               })
               ->when(request()->has('first_name'), function($query) {
                    return $query->where('first_name', 'like', '%'. request('first_name') .'%');
               })
               ->when(request()->has('email'), function($query) {
                    return $query->where('email', 'like', '%'. request('email') .'%');
               })
               ->when(request()->has('type'), function($query) {
                    return $query->where('type', request('type'));
               })
               ->when(request()->has('activate'), function($query) {
                    return $query->where('activate', request('activate') === 't');
               })
               ->get();

        $get_back = request()->all();

        return view('searchUser', compact('users', 'get_back'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('editUser', compact('user'));
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
        $request->validate([
            'last_name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'numeric', 'digits:10'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'postal_code' => ['required', 'string', 'digits:5'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => ['nullable', 'string', 'min:6', 'max:255', 'confirmed'],
        ]);

        $user->update($request->input()->except(['password', 'password_confirmation']));

        if ( exist(request('password')) )
            $user->password = request('password');

        flash("User ($user->last_name $user->first_name) updated successfully.")->success()->important();

        return redirect()->back();
    }

    /**
     * Activate or deactivate a user.
     *
     * @param  User user
     * @return \Illuminate\Http\Response
     */
    public function activate(User $user)
    {
        $user->activate();

        return redirect()->back();
    }
}
