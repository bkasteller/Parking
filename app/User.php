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
     * Retourne l'id du premier utilisateur de la file d'attente ou null si la file d'attente est vide.
     */
    function lastRank()
    {

    }

    /*
     * Retourne l'id du dernier utilisateur de la file d'attente ou null si la file d'attente est vide.
     */
    function firstRank()
    {

    }

    /*
     * Decremente de 1 le rank des utilisateurs supérieur au rank de l'utilisateur actuel, puis passe le rank de l'utilisateur à null.
     */
    function leaveRank()
    {

    }

    /*
     * Ajoute un utilisateur en dernière position de la liste d'attente
     */
    function joinRank()
    {

    }
}
