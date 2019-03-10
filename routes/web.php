<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'WelcomeController@index')
     ->name('home');

Auth::routes();

Route::get('/user', 'UserController@index')
     ->name('user');

Route::get('/password/update', 'UserController@showUpdatePassword')
     ->name('updatePassword');
Route::post('/password/update', 'UserController@updatePassword');

Route::group([
   'middleware' => ['is_admin']
], function () {
    Route::get('/admin', 'AdminController@index')
         ->name('admin');

    Route::get('/user/search', 'AdminController@searchUser')
        ->name('user.search');
    Route::post('/user/search', 'AdminController@searchUser');

    Route::get('/user/{user}/activate', 'AdminController@activate')
         ->name('user.activate');

    Route::resource('place', 'PlaceController');

    Route::resource('places', 'PlacesController');
});
