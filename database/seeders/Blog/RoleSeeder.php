<?php

namespace Database\Seeders\Blog;

use App\Models\Blog\BlogRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        BlogRole::create([
            'role_name' => 'admin'
        ]);
        BlogRole::create([
            'role_name' => 'editor'
        ]);
        BlogRole::create([
            'role_name' => 'blogger'
        ]);
    }
}
