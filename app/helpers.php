<?php

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
