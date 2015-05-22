<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Gig extends Model
{

  protected $fillable = ['datetime','venue_id'];

  /**
   * @param $value
   * @return string
   * @author Andrew Haswell
   */
  public function setCostAttribute($value)
  {
    return !empty($value) ? $value : 'Free';
  }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
   * @author Andrew Haswell
   */
  public function bands()
  {
    return $this->belongsToMany('App\Band')->withTimestamps();
  }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   * @author Andrew Haswell
   */
  public function venue()
  {
    return $this->belongsTo('App\Venue');
  }
}
