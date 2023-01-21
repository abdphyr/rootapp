<?php

namespace App\Policies\Ecommerce;

use App\Models\Ecommerce\Comment;
use App\Models\Ecommerce\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
  use HandlesAuthorization;

  public function update(User $user, Comment $comment)
  {
    return $user->isAdmin() || $user->id === $comment->user_id;
  }

  public function delete(User $user, Comment $comment)
  {
    return $user->isAdmin() || $user->id === $comment->user_id;
  }
}
