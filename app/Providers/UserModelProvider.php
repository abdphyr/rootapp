<?php

namespace App\Providers;

use App\Models\UserModel;
use Illuminate\Support\ServiceProvider;

class UserModelProvider extends ServiceProvider
{
  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    $this->app->alias(UserModel::class, "usermodel");
  }
}
