<?php

namespace App\Http\Controllers;

use App\Entry;
use App\User;
use Classes\APIResponseResult;
use Exception;
use Illuminate\Http\Request;
use Carbon\Carbon as Carbon;

class EntryController extends Controller
{
  /**
   * Get all the entries for all the users
   *
   * @return APIResponseResult
   */
  public function all()
  {
    try
    {
      $userentries = User::with('entries')
        ->get();
      $filteredUserEntries = [];
      //return APIResponseResult::OK($filteredUserEntries);
      foreach ($userentries as $user)
      {
        $filteredUserEntries = array_merge($filteredUserEntries,array_slice($user->entries->toArray(),0, 3));
      }
      usort($filteredUserEntries, function($a, $b) {
        if (Carbon::parse($a["creation_date"])->greaterThan(Carbon::parse($b["creation_date"])))
        {
          return -1;
        } 
        else if (Carbon::parse($a["creation_date"])->lessThan(Carbon::parse($b["creation_date"])))
        {
          return 1;
        }
        else
        {
          return 0;
        }
      });
      return APIResponseResult::OK($filteredUserEntries);
    }
    catch (Exception $e)
    {
      return APIResponseResult::ERROR("Some error ocurred. Details: " . $e->getMessage());
    }
  }
  /**
   * Get one entry
   *
   * @return APIResponseResult
   */
  public function get($id)
  {
    try
    {
      $entry = Entry::find($id);
      if (!$entry)
      {
        return APIResponseResult::ERROR("The Entry $id doesn't exists on the database");
      }
      return APIResponseResult::OK($entry);
    }
    catch (Exception $e)
    {
      return APIResponseResult::ERROR("Some error ocurred. Details: " . $e->getMessage());
    }
  }
  /**
   * Get all the entries for specific user
   *
   * @return APIResponseResult
   */
  public function list($id)
  {
    try
    {
      $entries = Entry::where("users_id", $id)
        ->orderBy("id", "desc");
      return APIResponseResult::OK($entries);
    }
    catch (Exception $e)
    {
      return APIResponseResult::ERROR("Some error ocurred. Details: " . $e->getMessage());
    }
  }
  /**
   * Inserts a new data for entries
   *
   * @return APIResponseResult
   */
  public function insert(Request $request)
  {
    try
    {
      $mytime = Carbon::now();
      $entry = new Entry;
      $entry->users_id = $request->users_id;
      $entry->creation_date = $mytime->toDateTimeString();
      $entry->title = $request->title;
      $entry->content = $request->content;
      $entry->save();
      return APIResponseResult::OK($entry); 
    }
    catch (Exception $e)
    {
      return APIResponseResult::ERROR("Some error ocurred. Details: " . $e->getMessage());
    }
  }
  /**
   * Updates the entry specified
   *
   * @return APIResponseResult
   */
  public function update(Request $request, $id)
  {
    try
    {
      $entry = Entry::find($id);
      if (!$entry)
      {
        return APIResponseResult::ERROR("The Entry $id doesn't exists on the database");
      }
      $entry->users_id = $request->users_id;
      $entry->title = $request->title;
      $entry->content = $request->content;
      $entry->save();
      return APIResponseResult::OK($entry); 
    }
    catch (Exception $e)
    {
      return APIResponseResult::ERROR("Some error ocurred. Details: " . $e->getMessage());
    }
  }
  /**
   * Delete the entry specified
   *
   * @return APIResponseResult
   */
  public function delete($id)
  {
    try
    {
      $entry = Entry::find($id);
      if (!$entry)
      {
        return APIResponseResult::ERROR("The Entry $id doesn't exists on the database");
      }
      $entry->delete();
      return APIResponseResult::OK();
    }
    catch (Exception $e)
    {
      return APIResponseResult::ERROR("Some error ocurred. Details: " . $e->getMessage());
    }
  }
}