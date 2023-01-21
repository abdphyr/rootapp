<?php

namespace Database\Seeders\Blog;

use App\Models\Blog\BlogPost;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run()
    {
        BlogPost::create([
            "blog_user_id" => 1,
            "blog_category_id" => 1,
            "title" => 'title_seeder',
            "short_content" => 'short_content_seeder',
            "content" => 'content_seeder'
        ]);
    }
}
