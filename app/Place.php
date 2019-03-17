<?php

namespace Parking;

use Illuminate\Database\Eloquent\Model;
use Parking\User;
use Parking\Booking;
use Carbon\Carbon;

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

    /*
     * Récupère la dernière réservation de la place.
     */
    function booking()
    {
        return Booking::where('place_id', $this->id)
                      ->orderBy('created_at', 'desc')
                      ->first();
    }

    /*
     * Récupère le dernier utilisateur de la place, si il existe.
     */
    function user()
    {
        return User::where('id', $this->booking()->user_id)
                      ->first();
    }

    /*
     * Retourne si la place est actuellement occupé par un user ou non.
     */
    function occupied()
    {
        return !empty($this->booking()) && !$this->booking()->isExpired();
    }

    /*
     * Passe une place en available = true.
     * Appel la fonction givePlace().
     */
    function placeAvailable()
    {
        $this->available = TRUE;
        $this->save();
        $this->givePlace();
    }

    /*
     * Libère la place actuelle et l'attribue a la réservation dont le rank = 1, puis appel leaveRank().
     */
    function givePlace()
    {
        $user = User::where('rank', 1)
                    ->first();

        if ( !empty($user) )
        {
            Booking::create(['user_id' => $user->id, 'place_id' => $this->id]);
            $user->leaveRank();
        }
    }
}
