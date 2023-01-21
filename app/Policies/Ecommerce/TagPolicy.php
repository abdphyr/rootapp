<?php

namespace App\Policies\Ecommerce;

use Illuminate\Auth\Access\HandlesAuthorization;

class TagPolicy
{
  use HandlesAuthorization, OnlyAdmin;
}
