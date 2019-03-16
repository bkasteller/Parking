<?php

namespace Parking;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = ['duration'];

    public $timestamps = false;

    public function user()
    {
      return $this->belongsTo('\Parking\User');
    }

    public function place()
    {
        return $this->belongsTo('\Parking\Place');
    }

    /*
     * Calcul une date fin en fonction d'une date de debut et un nombre de jours ajouté.
     */
    public function lastDay()
    {
        return toDate(toDate($this->created_at)." +".$this->duration." days");
    }

    /*
     * Calcul le nombre de jours restant entre la date actuel et une date de fin.
     */
    public function remainingDays()
    {
        return (strtotime($this->lastDay()) - strtotime(date("Y-m-d"))) / 86400;
    }

    /*
     * Vérifie si la date est inferieur à la date actuel.
     */
    public function isExpired()
    {
        return toDate($this->lastDay()) < date("Y-m-d");
    }
}
