<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogImage extends Model
{
    use HasFactory;
    protected $fillable = ['public_url', 'inner_url', 'imageable_id', 'imageable_type'];
    public function imageable()
    {
        return $this->morphTo();
    }
}
