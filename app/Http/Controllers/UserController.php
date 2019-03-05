<?php

namespace Parking\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Parking\User;

class UserController extends Controller
{
    public function index()
    {
    }

    public function update()
    {
    }

    public function activate()
    {
        if ( request('user_activate') )
          $activate = false;
        else
          $activate = true;

        DB::table('users')
          ->where('id', request('user_id'))
          ->update(array('activate' => $activate));

        return redirect('users');
    }

    public function delete()
    {
    }
}
