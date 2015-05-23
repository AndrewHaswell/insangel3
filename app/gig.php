<?php namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Gig extends Model
{

  protected $fillable = ['datetime',
                         'venue_id'];

  /**
   * @param $value
   * @return string
   * @author Andrew Haswell
   */
  public function setCostAttribute($value)
  {
    $this->attributes['cost'] = $value ?: 'Free';
  }

  /**
   * @param $value
   * @return string
   * @author Andrew Haswell
   */
  public function setNotesAttribute($value)
  {
    $this->attributes['notes'] = $value ?: '';
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

  /**
   * @param $query
   * @return mixed
   * @author Andrew Haswell
   */
  public function scopeAllByDate($query)
  {
    return $query->with('bands')->with('venue')->orderBy('datetime', 'asc');
  }

  /**
   * @param $query
   * @return mixed
   * @author Andrew Haswell
   */
  public function scopeAllCurrentByDate($query)
  {
    return $query->where('datetime', '>=', Carbon::now())->with('bands')->with('venue')->orderBy('datetime', 'asc');
  }
}
