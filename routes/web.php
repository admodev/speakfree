<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Web blade templates
Route::get('/', function () {
    return view('welcome');
})->name('home.view');

Route::get('/login', function () {
  return view('login');
})->name('login.view');

Route::get('/signup', function() {
  return view('signup');
})->name('signup.view');
