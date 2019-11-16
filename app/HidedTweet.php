<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HidedTweet extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'hided_tweets';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'users_id',
    'tweet_id'
  ];
}
