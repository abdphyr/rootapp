<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogRole extends Model
{
    use HasFactory;

    protected $fillable = ['role_name'];


    public function users()
    {
        return $this->belongsToMany(BlogUser::class);
    }
}
