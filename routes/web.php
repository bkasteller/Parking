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

Route::get('/', 'WelcomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')
     ->name('home');

Route::post('/changePassword', 'ChangePasswordController@change');
Route::get('/changePassword', 'ChangePasswordController@index')
     ->name('changePassword');

Route::group([
   'is_admin' => 'App\Http\Middleware\IsAdmin',
], function () {
    Route::post('/users', 'UsersController@index');
    Route::get('/users', 'UsersController@index')
         ->name('users');

    Route::get('/parkingPlaces', 'ParkingPlacesController@index')
         ->name('parkingPlaces');

    Route::get('/placeRequest', 'PlaceRequestController@index')
         ->name('placeRequest');

    Route::post('/updateUser', 'UserController@update');
    Route::get('/updateUser', 'UserController@index')
         ->name('updateUser');

    Route::post('/activateUser', 'UserController@activate')
         ->name('activateUser');

    Route::post('/deleteUser', 'UserController@delete')
         ->name('deleteUser');
});
