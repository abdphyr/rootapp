<?php

namespace Database\Seeders\Blog;

use App\Models\Blog\BlogTag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    public function run()
    {
        $tags = [
            ['tag_name' => 'Design'],
            ['tag_name' => 'Marketing'],
            ['tag_name' => 'SEO'],
            ['tag_name' => 'Writting'],
            ['tag_name' => 'Consulting'],
            ['tag_name' => 'Development'],
            ['tag_name' => 'Reading'],
        ];
        BlogTag::insert($tags);
    }
}
