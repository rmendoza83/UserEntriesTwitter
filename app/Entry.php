<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'entries';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'users_id',
    'creation_date',
    'title',
    'content'
  ];
  /**
   * The attributes that should be mutated to dates.
   *
   * @var array
   */
  protected $dates = [
    'creation_date'
  ];

  public function users() 
  {
    return $this->belongsTo('App\User');
  }
}
