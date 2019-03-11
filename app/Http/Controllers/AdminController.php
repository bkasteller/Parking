<?php

namespace Parking\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Parking\User;
use Illuminate\Validation\Rule;

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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showUser(User $user)
    {
        return view('showUser', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
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

        $user->lastName = request('lastName');
        $user->firstName = request('firstName');
        $user->email = request('email');
        if (!empty(request('password')))
          $user->password = Hash::make(request('new_password'));
        $user->address = request('address');
        $user->zipCode = request('zipCode');
        $user->city = request('city');
        $user->phoneNumber =request('phoneNumber');
        $user->type = request('type');
        $user->save();


        flash("User ($user->lastName $user->firstName) updated successfully.")->success()->important();

        return redirect()->route('user.search');
    }
}
