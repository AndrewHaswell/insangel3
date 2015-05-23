<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Band extends Model
{
  protected $fillable = ['band_name'];

  /**
   * @param $value
   * @author Andrew Haswell
   */
  public function setBandNameAttribute($value)
  {
    $this->attributes['band_name'] = $value ?: 'TBC';
  }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
   * @author Andrew Haswell
   */
  public function gigs()
  {
    return $this->belongsToMany('App\Gig')->withTimestamps();
  }
}
