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

    public function users()
    {
        return $this->belongsToMany('User');
    }

    public function reservations()
    {
        return $this->hasMany('\App\Booking');
    }
}
