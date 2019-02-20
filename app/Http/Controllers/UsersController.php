<?php

namespace Parking\Http\Controllers;

use Illuminate\Http\Request;
use Parking\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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

        return view('users', compact('users'));
    }
}
