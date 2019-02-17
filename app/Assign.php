<?php

namespace Parking;

use Illuminate\Database\Eloquent\Model;

class Assign extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'duration',
  ];
}
