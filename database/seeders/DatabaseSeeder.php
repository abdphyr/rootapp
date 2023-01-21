<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            \Database\Seeders\Ecommerce\RoleSeeder::class,
            \Database\Seeders\Ecommerce\UserSeeder::class,
            \Database\Seeders\Ecommerce\CategorySeeder::class,
            \Database\Seeders\Ecommerce\TagSeeder::class,
            \Database\Seeders\Ecommerce\ProductSeeder::class,
            \Database\Seeders\Blog\RoleSeeder::class,
            \Database\Seeders\Blog\UserSeeder::class,
            \Database\Seeders\Blog\TagSeeder::class,
            \Database\Seeders\Blog\CategorySeeder::class,
            \Database\Seeders\Blog\PostSeeder::class,
        ]);
    }
}
