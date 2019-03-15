<?php

function toDate($date)
{
    return date("Y-m-d", strtotime($date));
}


/*
 * Vérifie si la date est inferieur à la date actuel.
 */
function isExpired( )
{
    return toDate(lastDay( )) < date("Y-m-d");
}

/*
 * Calcul une date fin en fonction d'une date de debut et un nombre de jours ajouté.
 */
function lastDay( )
{
    return toDate(toDate( )." +". ." days");
}

/*
 * Calcul le nombre de jours restant entre la date actuel et une date de fin.
 */
function remainingDays( )
{
    return (strtotime(lastDay( )) - strtotime(date("Y-m-d"))) / 86400;
}

/*
 * Convertit une date en date comprehensible en francais.
 */
function dateToFrench($date)
{
    return date("d-m-Y", strtotime($date));
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

/*
 * Retourne un tableau contenant l'id et le rank de tout les utilisateurs en attente ou
 * un tableau vide si il n'y a aucun utilisateur dans la file d'attente.
 */
function isWaiting()
{

}

/*
 * Retourne l'id du premier utilisateur de la file d'attente ou null si la file d'attente est vide.
 */
function lastRank()
{

}

/*
 * Retourne l'id du dernier utilisateur de la file d'attente ou null si la file d'attente est vide.
 */
function firstRank()
{

}

/*
 * Decremente de 1 le rank des utilisateurs supérieur au rank de l'utilisateur actuel, puis passe le rank de l'utilisateur à null.
 */
function leaveRank()
{

}

/*
 * Ajoute un utilisateur en dernière position de la liste d'attente
 */
function joinRank()
{
  
}
