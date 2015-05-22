<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Band extends Model
{

  protected $fillable = ['band_name'];

  public function gigs()
  {
    return $this->belongsToMany('App\Gig')->withTimestamps();

  }
}
