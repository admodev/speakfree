<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use SpeakFree\Domain\Constants\RouteConstants;
use SpeakFree\Http\Controllers\AuthController;
use SpeakFree\Http\Controllers\HealthCheckController;
use SpeakFree\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix(RouteConstants::V1_GROUP_NAME)->group(function () {
  // RESOURCE ROUTES
  Route::resource('user', UserController::class);

  // GET
  Route::get('health', [HealthCheckController::class, 'index'])->name('health.check.get');

  // POST
  Route::post('auth/login', [AuthController::class, 'login'])->name('auth.login.post');
});
