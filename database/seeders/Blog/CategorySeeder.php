<?php

namespace Database\Seeders\Blog;

use App\Models\Blog\BlogCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        BlogCategory::create([
            'name' => 'Backend'
        ]);
        BlogCategory::create([
            'name' => 'Frontend'
        ]);
        BlogCategory::create([
            'name' => 'Mobile'
        ]);
        BlogCategory::create([
            'name' => 'Desktop'
        ]);
        BlogCategory::create([
            'name' => 'Data science'
        ]);
    }
}
