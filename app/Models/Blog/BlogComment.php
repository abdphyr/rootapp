<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{
    use HasFactory;
    
    protected $fillable = ['blog_user_id', 'blog_post_id', 'body'];

    public function blog_user() 
    {
        return $this->belongsTo(BlogUser::class);
    }


    public function blog_post() 
    {
        return $this->belongsTo(BlogPost::class);
    }
}
