<?php

namespace Parking;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $fillable = [
      'available',
    ];

    public $timestamps = false;

    public function users()
    {
        return $this->belongsToMany('User')->withPivot('date', 'duration');
    }
}
