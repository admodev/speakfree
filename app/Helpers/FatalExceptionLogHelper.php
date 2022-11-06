<?php

namespace SpeakFree\Helpers;

use Exception;
use Illuminate\Support\Facades\Log;

class FatalExceptionLogHelper
{
  public static function logFatalException(Exception $errorMessage)
  {
    return Log::emergency($errorMessage->getMessage());
  }
}
