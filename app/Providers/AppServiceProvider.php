<?php

namespace SpeakFree\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    $this->app->bind(
      'SpeakFree\Domain\RepositoryInterface',
      'SpeakFree\Domain\Repository',
      'SpeakFree\Domain\Users\UserRepositoryInterface',
      'SpeakFree\Domain\Users\UserRepository'
    );
  }

  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot()
  {
    //
  }
}
