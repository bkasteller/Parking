<?php

use Parking\Place;
use Parking\User;
use Parking\Booking;

/*
 * Mon format de date.
 */
function affDate($date)
{
    return Carbon::parse($date);
}

/*
 * Retroune si l'objet existe.
 */
function exist($object)
{
    return !empty($object);
}

/*
 * Retourne le rank du dernier utilisateur de la file d'attente ou 0 si la file d'attente est vide.
 */
function lastRank()
{
    return 0 + User::max('rank');
}

/*
 * Retourne une place éligible à la réservation.
 */
function getPlace()
{
    $places = Place::where('available', TRUE)->get();

    foreach ($places as $place) {
        if ( !$place->occupied() )
            return $place;
    }
}

/*
 * Retourne le premier utilisateur de la file d'attente.
 */
function getUser()
{
    return User::where('rank', 1)->first();
}

/*
 * Récupère une place disponible à la reservation et créé la reservation pour le premier utilisateur de la file d'attente
 */
function placeFinder()
{
    if ( exist(getPlace()) && exist(getUser()) )
        newBooking(getPlace(), getUser());
}

/*
 * Libère la place actuelle et l'attribue a la réservation dont le rank = 1, puis appel leaveRank().
 */
function newBooking(Place $place, User $user)
{
    Booking::create(['user_id' => $user->id, 'place_id' => $place->id]);
    $user->leaveRank();
    flash('Success you are assigned to the place N°'.$place->id.' !')->success()->important();
}
