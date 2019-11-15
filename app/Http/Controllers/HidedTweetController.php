<?php

namespace App\Http\Controllers;

use App\HidedTweet;
use Classes\APIResponseResult;
use Exception;

class HidedTweetController extends Controller
{
  /**
   * Get all the hided tweets for specific user
   *
   * @return APIResponseResult
   */
  public function get($id)
  {
    try
    {
      $hidedTweets = HidedTweet::where("id_user", $id)
        ->orderBy("id");
      return APIResponseResult::OK($hidedTweets);
    }
    catch (Exception $e)
    {
      return APIResponseResult::ERROR("Some error ocurred. Details: ", $e->getMessage());
    }
  }

  /**
   * Get all the hided tweets for all the user
   *
   * @return APIResponseResult
   */
  public function list()
  {
    try
    {
      $hidedTweets = HidedTweet::all();
      return APIResponseResult::OK($hidedTweets);
    }
    catch (Exception $e)
    {
      return APIResponseResult::ERROR("Some error ocurred. Details: ", $e->getMessage());
    }
  }
  /**
   * Inserts a new data for hided tweets (or Hide Tweet)
   *
   * @return APIResponseResult
   */
  public function insert(Request $request)
  {
    try
    {
      $hidedTweet = new HidedTweeet;
      $hidedTweet->id_user = $request->id_user;
      $hidedTweet->id_tweet = $request->id_user;
      $hidedTweet->save();
      return APIResponseResult::OK($hidedTweet); 
    }
    catch (Exception $e)
    {
      return APIResponseResult::ERROR("Some error ocurred. Details: ", $e->getMessage());
    }
  }
  /**
   * Delete the hided tweet specified (or Un-Hide Tweet)
   *
   * @return APIResponseResult
   */
  public function delete($id)
  {
    try
    {
      $hidedTweet = HidedTweet::find($id);
      if (!$hidedTweet)
      {
        return APIResponseResult::ERROR("The Hided Tweet $id doesn't exists on the database");
      }
      $hidedTweet->delete();
      return APIResponseResult::OK();
    }
    catch (Exception $e)
    {
      return APIResponseResult::ERROR("Some error ocurred. Details: ", $e->getMessage());
    }
  }
}
