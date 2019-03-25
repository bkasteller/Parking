<?php

namespace Parking;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
    protected $fillable = ['last_name', 'first_name', 'email', 'phone_number', 'address', 'postal_code', 'city', 'password'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token', 'activate', 'type', 'rank'];

    protected $dates = ['created_at', 'updated_at'];

    public function isAdmin()
    {
        return $this->type === self::ADMIN_TYPE;
    }

    /*
     * Retourne toute les réservations de l'utilisateur.
     */
    public function bookings()
    {
        return $this->hasMany('\Parking\Booking');
    }

    /*
     * Récupère la dernière réservation de l'utilisateur.
     */
    public function booking()
    {
        return $this->bookings()->orderBy('created_at', 'desc')->first();
    }

    /*
     * Retourne la place actuellement attribué à l'utilisateur ou NULL sinon.
     */
    public function place()
    {
        return (!empty($this->booking())
              && !$this->booking()->isExpired()) ? $this->booking()->place : NULL;
    }

    /*
     * Decremente de 1 le rank des utilisateurs supérieur au rank de l'utilisateur actuel, puis passe le rank de l'utilisateur à null.
     */
    public function leaveRank()
    {
        if ( !empty($this->rank) )
        {
            User::whereNotNull('rank')
                ->where('rank', '>', $this->rank)
                ->decrement('rank', 1);
            $this->rank = NULL;
            $this->save();
        }
    }

    /*
     * Ajoute un utilisateur en dernière position de la liste d'attente
     */
    public function joinRank()
    {
        if ( empty($this->rank) )
        {
            $this->rank = lastRank() + 1;
            $this->save();
        }
    }

    /*
     * Ajoute un utilisateur au rang passé en paramètre
     */
    public function updateRank($rank)
    {
        if ( empty($this->rank) )
        {
            $this->leaveRank();
            User::whereNotNull('rank')
                ->where('rank', '>=', $rank)
                ->increment('rank', 1);
            $this->rank = $rank;
            $this->save();
        }
    }
}
