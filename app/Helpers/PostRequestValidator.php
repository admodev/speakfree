<?php

namespace SpeakFree\Helpers;

use Exception;
use Illuminate\Support\Facades\Validator;
use SpeakFree\Domain\Constants\HttpConstants;
use SpeakFree\Helpers\ExceptionLogHelper;
use SpeakFree\Helpers\ResponseHelper;

class PostRequestValidator
{
  public static function validatePostRequestFields(array $fields, $rules)
  {
    return self::fieldsValidationAttempt($fields, $rules);
  }

  private static function fieldsValidationAttempt(array $fields, $rules)
  {
    try {
      $validator = Validator::make($fields, $rules);

      if ($validator->fails()) {
        return ResponseHelper::createResponse($validator->messages(), HttpConstants::BAD_REQUEST_CODE);
      }

      return $validator;
    } catch (Exception $error) {
      return ExceptionLogHelper::logException($error);
    }
  }
}
