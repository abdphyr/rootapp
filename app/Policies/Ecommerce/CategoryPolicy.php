<?php

namespace App\Policies\Ecommerce;

use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
  use HandlesAuthorization, OnlyAdmin;
}
