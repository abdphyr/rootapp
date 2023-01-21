<?php

namespace App\Policies\Ecommerce;

use App\Models\Ecommerce\User;

trait OnlyAdmin
{
  public function create(User $user)
  {
    return $user->isAdmin();
  }

  public function update(User $user)
  {
    return $user->isAdmin();
  }

  public function delete(User $user)
  {
    return $user->isAdmin();
  }
}
