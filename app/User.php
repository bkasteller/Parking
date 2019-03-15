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

    public function places()
    {
        return $this->belongsToMany('Parking\Place');
    }

    public function booking()
    {
        return $this->hasMany('\Parking\Booking');
    }
}
