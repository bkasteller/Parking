<?php

namespace Parking;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
      'rank',
    ];

    public $timestamps = false;

    public function user()
    {
        $this->belongsTo('User');
    }
}
