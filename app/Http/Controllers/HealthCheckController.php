<?php

namespace SpeakFree\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use SpeakFree\Domain\Constants\HealthCheckConstants;
use SpeakFree\Helpers\ResponseHelper;

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
      return $this->logServerDownError($error);
    }
  }

  protected function logServerDownError(Exception $errorMessage)
  {
    Log::emergency($errorMessage->getMessage());
  }
}
