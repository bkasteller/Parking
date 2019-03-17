<?php

namespace Parking;

use Illuminate\Database\Eloquent\Model;
use Parking\User;

class Booking extends Model
{
    protected $fillable = ['duration', 'user_id', 'place_id'];

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
        return $this->remainingDays() <= 0;
    }

    /*
     * Arrêt d'une reservation en cours.
     */
    public function abort()
    {
        $place = Place::find($this->place_id)
                      ->first();
        $this->duration = (strtotime(date("Y-m-d")) - strtotime(toDate($this->created_at))) / 86400;

        $place->placeAvailable();
        $this->save();
    }
}
