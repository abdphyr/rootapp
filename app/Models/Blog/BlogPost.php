<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;
    protected $fillable = ['blog_user_id', 'blog_category_id','title', 'short_content', 'content', 'public_photo', 'inner_photo'];

    protected $casts = [
        "created_at" => "datetime:Y-m-d"
    ];
    public function blog_user() 
    {
        return $this->belongsTo(BlogUser::class);
    }


    public function blog_category()
    {
        return $this->belongsTo(BlogCategory::class);
    }


    public function comments()
    {
        return $this->hasMany(BlogComment::class);
    }


    public function tags()
    {
        return $this->belongsToMany(BlogTag::class);
    }
    
    
    public function image()
    {
        return $this->morphOne(BlogImage::class, 'imageable');
    }
}
