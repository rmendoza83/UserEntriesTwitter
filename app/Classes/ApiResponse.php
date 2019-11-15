<?php

namespace Classes;

use Classes\Constants;

class APIResponseResult
{
  public static function OK($data = null)
  {
    return response()->json([
      'statusCode' => Constants::API_RESPONSE_STATUS_CODE_OK,
      'data' => $data
    ]);
  }

  public static function ERROR($error)
  {
    return response()->json([
      'statusCode' => Constants::API_RESPONSE_STATUS_CODE_BAD_REQUEST,
      'errorMessage' => $error
    ]);
  }
}
