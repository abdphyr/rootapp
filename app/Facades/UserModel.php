<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class UserModel extends Facade
{
  protected static function getFacadeAccessor()
  {
    return 'usermodel';
  }
}
