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

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/changePassword', 'ChangePasswordController@index')->name('changePassword');
Route::post('/changePassword', 'ChangePasswordController@change');

Route::get('/users', 'UsersController@index')->name('users');
Route::post('/users', 'UsersController@index');

Route::get('/parkingPlaces', 'ParkingPlacesController@index')->name('parkingPlaces');

Route::get('/placeRequest', 'PlaceRequestController@index')->name('placeRequest');
