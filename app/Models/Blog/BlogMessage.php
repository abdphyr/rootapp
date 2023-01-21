<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogMessage extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'subject', 'message'];
}
