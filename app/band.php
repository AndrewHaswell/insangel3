<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Band extends Model
{
  protected $fillable = ['band_name',
                         'band_description',
                         'band_logo'];

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

  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   * @author Andrew Haswell
   */
  public function images()
  {
    return $this->hasMany('App\Band_image');
  }
}
