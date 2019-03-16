<?php

use Parking\Booking;
use Parking\User;
use Parking\Place;

/*
 * Change the date format
 */
function toDate($date)
{
    return date("Y-m-d", strtotime($date));
}

/*
 * Convertit une date en date comprehensible en francais.
 */
function dateToFrench($date)
{
    return date("d-m-Y", strtotime($date));
}

/*
 * Récupère la dernière réservation de la place.
 */
function place_booking($place)
{
    return Booking::where('place_id', $place->id)
                  ->orderBy('created_at', 'desc')
                  ->first();
}

/*
 * Récupère le dernier utilisateur de la place, si il existe.
 */
function place_user($place)
{
    if ( place_booking($place) )
        return User::where('id', place_booking($place)->id)
                      ->first();
    return 0;
}

/*
 * Retourne si la place est actuellement occupé par un user ou non.
 */
function occupied($place)
{
    return !empty(place_booking($place)) && !place_booking($place)->isExpired();
}

/*
 * Passe une place en available = true.
 * Appel la fonction givePlace().
 */
function placeAvailable(Place $place)
{

}

/*
 * Vérifie si il existe une place de libre et l'attribue a la réservation dont le rank = 1, puis appel leaveRank().
 */
function givePlace(Place $place)
{

}
