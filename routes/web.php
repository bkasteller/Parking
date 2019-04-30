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
    ->name('welcome');

Auth::routes();

Route::group([
   'middleware' => ['is_activate']
], function () {

    Route::get('/home', 'UserController@index')
        ->name('home');

    /*
     * Affiche la vue contenant le formulaire pour le mot de passe.
     */
    Route::get('/password', 'PasswordController@edit')
        ->name('password.edit');

    /*
     * Vérifie si la requete est valide et met à jours le mot de passe de l'utilisateur connecté.
     */
    Route::post('/password', 'PasswordController@update')
        ->name('password.update');

    /*
     * Vérifie si il existe une place de libre,
     * Si non, appel joinRank().
     * Si oui, passe la place en available = false et créé la réservation.
     */
    Route::get('/booking/create', 'BookingController@create')
        ->name('booking.create');

    /*
     * Si l'utilisateur à un rank, appel leaveRank().
     */
    Route::get('/booking/cancel', 'BookingController@cancel')
        ->name('booking.cancel');

    /*
     * Permet d'acceder à l'historique d'une place de l'utilisateur.
     */
    Route::get('/booking/{booking}', 'BookingController@show')
        ->name('booking.show');
});

Route::group([
   'middleware' => ['is_admin', 'is_activate']
], function () {

    /*
     * Modifie la durée de la reservation et appel la fonction placeAvailable().
     */
    Route::get('/booking/{booking}/delete', 'BookingController@destroy')
        ->name('booking.delete');

    /*
     * Affiche tout les utilisateurs.
     */
    Route::get('/user/show/all', 'UserController@show')
        ->name('user.show');

    /*
     * Affiche un groupe d'utilisateurs spécifié par une requete.
     */
    Route::post('/user/show', 'UserController@show')
        ->name('user.search');

    /*
     * Affiche sous forme de formulaire, les informations d'un utilisateur.
     */
    Route::get('/user/{user}/edit', 'UserController@edit')
        ->name('user.edit');

    /*
     * Met à jours les informations d'un utilisateur récuperé d'un formulaire.
     */
    Route::post('/user/{user}/update', 'UserController@update')
        ->name('user.update');

    /*
     * Active ou desactive un utilisateur.
     */
    Route::get('/user/{user}/activate', 'UserController@activate')
        ->name('user.activate');

    /*
     * Affiche toute les places de parking.
     */
    Route::get('/place/show/all', 'PlaceController@show')
        ->name('place.show');

    /*
     * Créé une nouvelle place.
     */
    Route::get('/place/create', 'PlaceController@create')
        ->name('place.create');

    /*
     * Affiche les informations d'une place.
     */
    Route::get('/place/{place}/edit', 'PlaceController@edit')
        ->name('place.edit');

    /*
     * Rend disponible ou indisponible une place.
     */
    Route::get('/place/{place}/update', 'PlaceController@update')
        ->name('place.update');

    /*
     * Affiche la liste d'attente.
     */
    Route::get('/waitingList/edit', 'WaitingListController@edit')
        ->name('waitingList.edit');

    /*
     * Met à jours l'odre des positions de la liste d'attente.
     */
    Route::post('/waitingList/update', 'WaitingListController@update')
        ->name('waitingList.update');

    /*
     * Supprime un utilisateur de la file d'attente en appellant leaveRank().
     */
    Route::get('/waitingList/{user}/delete', 'WaitingListController@destroy')
        ->name('waitingList.delete');
});
