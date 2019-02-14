<?php

namespace Parking;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'rank',
  ];
}
