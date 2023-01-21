<?php

namespace App\Http\Controllers\Exceptions;

use \Exception;

class NotFoundException extends Exception
{
  protected $code = 404;
  public function getError()
  {
    return ['error' => $this->message];
  }
}
