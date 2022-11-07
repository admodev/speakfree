<?php

namespace SpeakFree\Helpers;

use Exception;

use SpeakFree\Domain\Constants\HealthCheckConstants;
use SpeakFree\Helpers\FatalExceptionLogHelper;

class ResponseHelper
{
  public static function createResponse($jsonData, $responseCode)
  {
    return self::constructResponse($jsonData, $responseCode);
  }

  private static function constructResponse($jsonData, $responseCode)
  {
    try {
      $responseType = null;

      switch ($responseCode) {
        case $responseCode >= 200 && $responseCode <= 299:
          $responseType = 'success';
          break;
        case $responseCode >= 300 && $responseCode <= 399:
          $responseType = 'redirected';
          break;
        case $responseCode >= 400 && $responseCode <= 499:
          $responseType = 'bad_request';
          break;
        default:
          $responseType = 'server_error';
          break;
      }

      return response()->json([$responseType => $jsonData], $responseCode);
    } catch (Exception $error) {
      return FatalExceptionLogHelper::logFatalException($error);
    }
  }
}
