<?php

namespace App\Http\Controllers;

use App\User;
use Classes\APIResponseResult;
use Exception;

class UserController extends Controller
{
  /**
   * Get one user
   *
   * @return APIResponseResult
   */
  public function get($id)
  {
    try
    {
      $user = User::find($id);
      if (!$user)
      {
        return APIResponseResult::ERROR("The User $id doesn't exists on the database");
      }
      return APIResponseResult::OK($user);
    }
    catch (Exception $e)
    {
      return APIResponseResult::ERROR("Some error ocurred. Details: " . $e->getMessage());
    }
  }
}
