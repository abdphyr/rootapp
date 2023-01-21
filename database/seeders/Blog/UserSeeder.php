<?php

namespace Database\Seeders\Blog;

use App\Models\Blog\BlogUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $admin = BlogUser::create([
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin9999')
        ]);
        $admin->roles()->attach([1, 3]);

        $editor = BlogUser::create([
            'username' => 'editor',
            'email' => 'editor@gmail.com',
            'password' => Hash::make('editor9999')
        ]);
        $editor->roles()->attach([2]);
    }
}
