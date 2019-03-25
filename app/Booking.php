<?php

namespace Parking;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Booking extends Model
{
    protected $fillable = ['duration', 'user_id', 'place_id'];

    /*
     * Retourne l'utilisateur ayant fait la réservation.
     */
    public function user()
    {
      return $this->belongsTo('\Parking\User');
    }

    /*
     * Retourne la place concerné par la reservation.
     */
    public function place()
    {
        return $this->belongsTo('\Parking\Place');
    }

    /*
     * Retourne la date de fin en ajoutant la durée à la date de création.
     */
    public function lastDay()
    {
        return $this->created_at->addDays($this->duration);
    }

    /*
     * Retourne le nombre jours restant avant l'expiration de la reservation.
     */
    public function remainingDays()
    {
        return $this->lastDay()->diffInDays(Carbon::now());
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
        $this->duration = $this->created_at->diffInDays(Carbon::now());
        $this->save();
    }
}
