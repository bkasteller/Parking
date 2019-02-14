<?php

namespace Parking;

use Illuminate\Database\Eloquent\Model;

class ParkingPlace extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'status',
  ];
}
