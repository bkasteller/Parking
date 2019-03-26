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
     * Retourne l'utilisateur actuel de la place, NULL sinon.
     */
    public function user()
    {
        return exist($this->booking())
              && !$this->booking()->isExpired()
              ? $this->booking()->user : NULL;
    }

    /*
     * Retourne si la place est actuellement occupé par un user ou non.
     */
    public function occupied()
    {
        return exist($this->booking()) && !$this->booking()->isExpired();
    }

    /*
     * Inverse la valeur du boolean available de la place.
     * Si la place se ferme et qu'un utilisateur est assigné à la place, interromp la reservation.
     */
    public function available()
    {
        $this->eject_user();
        $this->available = !$this->available;
        $this->save();
    }

    /*
     * Ejecte l'utilisateur de la place.
     */
    public function eject_user()
    {
          if ( exist($this->user()) )
          {
              $this->booking()->abort();
              return 1;
          }
          return 0;
    }
}
