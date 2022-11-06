<?php

namespace SpeakFree\Helpers;

use Exception;

use SpeakFree\Domain\Constants\HealthCheckConstants;
use SpeakFree\Helpers\FatalExceptionLogHelper;

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
      return FatalExceptionLogHelper::logFatalException($error);
    }
  }
}
