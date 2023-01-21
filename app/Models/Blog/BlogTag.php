<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogTag extends Model
{
    use HasFactory;

    protected $fillable = ['tag_name'];


    public function posts()
    {
        return $this->belongsToMany(BlogPost::class);
    }
}
