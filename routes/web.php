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
Route::get('/regtest', function(){
  return "salut";
});
Route::get('/regtest/{name}', function($name){
  return "salut $name" ;
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/changePassword', 'ChangePasswordController@index')->name('changePassword');
Route::post('/changePassword', 'ChangePasswordController@change');


Route::get('/placeRequest', 'PlaceRequestController@index')->name('placeRequest');
