<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Gig extends Model
{

  public function bands()
  {
    return $this->belongsToMany('App\Band');
  }

  public function venue()
  {
    return $this->belongsTo('App\Venue');
  }
}
