<?php

namespace App\Policies\Blog;

use App\Models\Blog\BlogPost;
use App\Models\Blog\BlogUser;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

   
    public function viewAny(BlogUser $user)
    {
        return true;
    }

    
    public function view(BlogUser $user, BlogPost $post)
    {
        return true;
    }

   
    public function create(BlogUser $user)
    {
        foreach ($user->roles as $role) {
            if ($role->role_name === 'admin' || $role->role_name === 'blogger' || $role->role_name === 'editor') {
                return true;
            }
        }
        return true;
    }

    
    public function update(BlogUser $user, BlogPost $post)
    {
        foreach ($user->roles as $role) {
            if ($role->role_name === 'admin') {
                return true;
            }
        }
        return $user->id === $post->blog_user_id;
    }

    
    public function delete(BlogUser $user, BlogPost $post)
    {
        foreach ($user->roles as $role) {
            if ($role->role_name === 'admin') {
                return true;
            }
        }
        return $user->id === $post->blog_user_id;
    }

    
    public function restore(BlogUser $user, BlogPost $post)
    {
        return true;
    }

    
    public function forceDelete(BlogUser $user, BlogPost $post)
    {
        return true;
    }
}
