<?php

namespace App\Http\Controllers;

use App\Entry;
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
      $entries = Entry::all();
      return APIResponseResult::OK($entries);
    }
    catch (Exception $e)
    {
      return APIResponseResult::ERROR("Some error ocurred. Details: ", $e->getMessage());
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
      return APIResponseResult::ERROR("Some error ocurred. Details: ", $e->getMessage());
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
      $entries = Entry::where("id_user", $id)
        ->orderBy("id", "desc");
      return APIResponseResult::OK($entries);
    }
    catch (Exception $e)
    {
      return APIResponseResult::ERROR("Some error ocurred. Details: ", $e->getMessage());
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
      $entry->id_user = $request->id_user;
      $entry->creation_date = $mytime->toDateTimeString();
      $entry->title = $request->title;
      $entry->content = $request->content;
      $entry->save();
      return APIResponseResult::OK($entry); 
    }
    catch (Exception $e)
    {
      return APIResponseResult::ERROR("Some error ocurred. Details: ", $e->getMessage());
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
      $entry->id_user = $request->id_user;
      $entry->title = $request->title;
      $entry->content = $request->content;
      $entry->save();
      return APIResponseResult::OK($entry); 
    }
    catch (Exception $e)
    {
      return APIResponseResult::ERROR("Some error ocurred. Details: ", $e->getMessage());
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
      return APIResponseResult::ERROR("Some error ocurred. Details: ", $e->getMessage());
    }
  }
}