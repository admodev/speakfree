<?php

namespace SpeakFree\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

use SpeakFree\Domain\Constants\HealthCheckConstants;
use SpeakFree\Helpers\ResponseHelper;
use SpeakFree\Helpers\FatalExceptionLogHelper;

class HealthCheckController extends Controller
{
  public function index()
  {
    return $this->checkServerHealth();
  }

  protected function checkServerHealth()
  {
    try {
      return ResponseHelper::createResponse(HealthCheckConstants::OKAY_MESSAGE);
    } catch (Exception $error) {
      return FatalExceptionLogHelper::logFatalException($error);
    }
  }
}
