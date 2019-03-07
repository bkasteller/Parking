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

Route::resource('user','UserController');

Route::post('/changePassword', 'ChangePasswordController@change');
Route::get('/changePassword', 'ChangePasswordController@index')
     ->name('changePassword');

Route::group([
   'is_admin' => 'App\Http\Middleware\IsAdmin',
], function () {
    Route::get('/places', 'PlacesController@index')
         ->name('places');

    Route::get('/places/add', 'PlacesController@add');

    Route::get('/places/delete', 'PlacesController@delete');

    Route::get('/places/{id}', 'PlacesController@describe');

    Route::get('/placeRequest', 'PlacesController@request')
         ->name('placeRequest');

    Route::post('/users', 'UsersController@index');
    Route::get('/users', 'UsersController@index')
        ->name('users');

    Route::post('/updateUser', 'UserController@update');
    Route::get('/updateUser', 'UserController@index')
         ->name('updateUser');

    Route::post('/activateUser', 'UserController@activate')
         ->name('activateUser');

    Route::post('/deleteUser', 'UserController@delete')
         ->name('deleteUser');
});
