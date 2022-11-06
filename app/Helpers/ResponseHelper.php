<?php

namespace SpeakFree\Helpers;

use Exception;
use Illuminate\Support\Facades\Log;
use SpeakFree\Domain\Constants\HealthCheckConstants;

class ResponseHelper
{
  public static function createResponse($jsonData)
  {
    return self::constructResponse($jsonData);
  }

  private static function constructResponse($jsonData)
  {
    try {
      return response()->json(['success' => $jsonData], HealthCheckConstants::OKAY_CODE);
    } catch (Exception $error) {
      Log::error($error->getMessage());
    }
  }
}
