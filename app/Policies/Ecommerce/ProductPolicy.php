<?php

namespace App\Policies\Ecommerce;

use App\Models\Ecommerce\Product;
use App\Models\Ecommerce\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
  use HandlesAuthorization;

  public function update(User $user, Product $product)
  {
    return $user->isAdmin() || $user->id === $product->user_id;
  }

  public function delete(User $user, Product $product)
  {
    return $user->isAdmin() || $user->id === $product->user_id;
  }
}
