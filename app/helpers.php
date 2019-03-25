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
 * Recherche si il existe une place de libre et appel la fonction d'attribution de la place.
 */
function placeFinder()
{
    $places = Place::where('available', TRUE)->get();

    foreach ($places as $place) {
        $user = User::where('rank', 1)->first();

        if ( exist($user) && !$place->occupied() )
            newBooking($place, $user);
    }
}

/*
 * Libère la place actuelle et l'attribue a la réservation dont le rank = 1, puis appel leaveRank().
 */
function newBooking(Place $place, User $user)
{
    Booking::create(['user_id' => $user->id, 'place_id' => $place->id]);
    $user->leaveRank();
    flash('Success you have find a place !')->success()->important();
}
