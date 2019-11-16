<?php

namespace App\Http\Controllers;

class ProfileController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index($id)
  {
    $user_id = $id;
    return view('profile.index', compact('user_id'));
  }
}
