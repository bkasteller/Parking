<?php

namespace Parking;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['available'];

    public $timestamps = false;

    /*
     * Récupère toute les réservation de la place.
     */
    public function bookings()
    {
        return $this->hasMany('\Parking\Booking');
    }
}
