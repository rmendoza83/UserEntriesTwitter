<?php

namespace App\Http\Controllers;

use Classes\Constants;
use Classes\TwitterAPIExchange;

class TwitterController extends Controller
{
  /**
   * Get twitter app settings 
   *
   * @return void
   */
  private function getTwitterSettings()
  {
    return [
      "oauth_access_token" => env("TWITTER_ACCESS_TOKEN", null),
      "oauth_access_token_secret" => env("TWITTER_ACCESS_TOKEN_SECRET", null),
      "consumer_key" => env("TWITTER_CONSUMER_KEY", null),
      "consumer_secret" => env("TWITTER_CONSUMER_SECRET", null),
    ];
  }
  /**
   * Get all the tweets for specific user
   *
   * @return void
   */
  public function get($id)
  {
    $url = Constants::TWITTER_USER_TIMELINE_URL;
    $requestMethod = "GET";
    $fields = [
      "screen_name" => $id,
      "count" => Constants::TWITTER_MAX_COUNT_TWEETS
    ];
    $twitter = new TwitterAPIExchange($this->getTwitterSettings());
    $response = $twitter->setGetfield("?". http_build_query($fields))
      ->buildOauth($url, $requestMethod)
      ->performRequest();
    
    return $response;
  }

  /**
   * Get all the tweets for all the user
   *
   * @return void
   */
  public function list()
  {
    
  }
}
