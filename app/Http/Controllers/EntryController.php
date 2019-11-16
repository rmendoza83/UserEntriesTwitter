<?php

namespace App\Http\Controllers;

use App\Entry;
use App\User;
use Classes\APIResponseResult;
use Exception;
use Illuminate\Support\Facades\Auth;
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
    try {
      $userentries = User::with('entries')
        ->get();
      $filteredUserEntries = [];
      foreach ($userentries as $user) {
        $temporalEntries = array_slice($user->entries->toArray(), 0, 3);
        for ($i = 0; $i < count($temporalEntries); $i++) {
          $temporalEntries[$i]["name"] = $user->name;
          $temporalEntries[$i]["twiter_username"] = $user->twitter_username;
        }
        $filteredUserEntries = array_merge($filteredUserEntries, $temporalEntries);
      }
      usort($filteredUserEntries, function ($a, $b) {
        $datea = Carbon::parse($a["created_at"]);
        $dateb = Carbon::parse($b["created_at"]);
        if ($datea->greaterThan($dateb)) {
          return -1;
        } else if ($datea->lessThan($dateb)) {
          return 1;
        } else {
          return 0;
        }
      });
      return APIResponseResult::OK($filteredUserEntries);
    } catch (Exception $e) {
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
      $userentries = Entry::where("users_id", $id)
        ->orderBy("creation_date", "desc")
        ->get();
      return APIResponseResult::OK($userentries);
    }
    catch (Exception $e)
    {
      return APIResponseResult::ERROR("Some error ocurred. Details: " . $e->getMessage());
    }
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $entries = Auth::user()->entries()->orderBy('created_at', 'desc')->get();
    return view('entries.index', compact('entries'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('entries.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    //Validate
    $request->validate([
      'title' => ['required', 'string', 'max:255'],
      'content' => ['required'],
    ]);
    $mytime = Carbon::now();
    $entry = new Entry;
    $entry->users_id = Auth::id();
    $entry->title = $request->title;
    $entry->content = $request->content;
    $entry->creation_date = $mytime->toDateTimeString();
    $entry->save();
    return redirect('/entries')->with('success', 'Entry was successfully saved');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $entry = Entry::find($id);

    return view('entries.show', compact('entry'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $entry = Entry::find($id);

    return view('entries.edit', compact('entry'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    //Validate
    $validatedData = $request->validate([
      'title' => ['required', 'string', 'max:255'],
      'content' => ['required'],
    ]);

    $entry = Entry::find($id);
    $entry->title = $request->title;
    $entry->content = $request->content;
    $entry->save();

    return redirect('/entries')->with('success', 'Entry was successfully updated');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $entry = Entry::find($id);
    $entry->delete();

    return redirect('/entries')->with('success', 'Entry was successfully deleted');
  }
}
