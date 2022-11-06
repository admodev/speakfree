<?php

namespace SpeakFree\Helpers;

use Exception;
use Illuminate\Support\Facades\Log;

class ExceptionLogHelper
{
  public static function logException(Exception $errorMessage)
  {
    return Log::error($errorMessage->getMessage());
  }
}
