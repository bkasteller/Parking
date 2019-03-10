<?php

function toDate($date)
{
    return date("Y-m-d", strtotime($date));
}

function isExpired($place)
{
    return toDate($place->pivot->date) < date("Y-m-d");
}

function lastDay($place)
{
    return toDate(toDate($place->pivot->date)." +".$place->pivot->duration." days");
}

function remainingDays($place)
{
    return (strtotime(lastDay($place)) - strtotime(date("Y-m-d"))) / 86400;
}

function dateToFrench($date)
{
    return date("d-m-Y", strtotime($date));
}

function notEmpty($object)
{
    return count($object) != 0;
}
