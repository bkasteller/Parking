<?php

namespace Parking;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = ['date', 'duration', 'user_id', 'place_id'];

    public $timestamps = false;

    public function user()
    {
      return $this->belongsTo('\Parking\User');
    }

    public function place()
    {
        return $this->belongsTo('\Parking\Place');
    }
}
