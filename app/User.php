<?php

namespace Parking;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Parking\Booking;

class User extends Authenticatable
{
    use Notifiable;

    const ADMIN_TYPE = 'admin';
    const DEFAULT_TYPE = 'member';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['lastName', 'firstName', 'email', 'password', 'phoneNumber', 'address', 'zipCode', 'city', 'activate', 'type', 'rank'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function isAdmin()
    {
        return $this->type === self::ADMIN_TYPE;
    }

    public function bookings()
    {
        return $this->hasMany('\Parking\Booking');
    }

    /*
     * Récupère la dernière réservation de la place.
     */
    function booking()
    {
        return Booking::where('user_id', $this->id)
                      ->orderBy('created_at', 'desc')
                      ->first();
    }

    /*
     * Récupère la place attribué à l'utilisateur.
     */
    function place()
    {

    }

    /*
     * Retourne le rank du dernier utilisateur de la file d'attente ou 0 si la file d'attente est vide.
     */
    function lastRank()
    {
        $last_rank = User::max('rank');

        if ( empty($last_rank) )
            $last_rank = 0;

        return $last_rank;
    }

    /*
     * Decremente de 1 le rank des utilisateurs supérieur au rank de l'utilisateur actuel, puis passe le rank de l'utilisateur à null.
     */
    function leaveRank()
    {
        User::where('rank', '!=', NULL)
            ->where('rank', '>', $this->rank)
            ->decrement('rank', 1);

        $this->rank = NULL;
        $this->save();
    }

    /*
     * Ajoute un utilisateur en dernière position de la liste d'attente
     */
    function joinRank()
    {
        $this->rank = $this->lastRank() + 1;
        $this->save();
    }

    /*
     *  Return or not, the place assigned to the user
     */
     function havePlace()
     {
        return !empty($this->booking()) && $this->booking()->duration > 0;
     }
}
