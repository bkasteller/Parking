<?php

namespace Parking;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['available'];

    /*
     * Récupère toute les réservation de la place.
     */
    public function bookings()
    {
        return $this->hasMany('\Parking\Booking');
    }

    /*
     * Retourne la dernière réservation de la place, NULL sinon.
     */
    public function booking()
    {
        return $this->bookings()->orderBy('created_at', 'desc')->first();
    }

    /*
     * Retourne le dernier utilisateur de la place, si il existe, NULL sinon.
     */
    public function user()
    {
        return exist($this->booking()) ? $this->booking()->user : NULL;
    }

    /*
     * Retourne si la place est actuellement occupé par un user ou non.
     */
    public function occupied()
    {
        return exist($this->booking()) && !$this->booking()->isExpired();
    }
}
