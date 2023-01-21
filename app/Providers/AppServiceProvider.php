<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \App\Http\Resources\Ecommerce\CategoryResource::withoutWrapping();
        \App\Http\Resources\Ecommerce\UserResource::withoutWrapping();
        \App\Http\Resources\Ecommerce\RoleResource::withoutWrapping();
        \App\Http\Resources\Ecommerce\ProductResource::withoutWrapping();
        \App\Http\Resources\Ecommerce\ImageResource::withoutWrapping();
        \App\Http\Resources\Blog\CategoryResource::withoutWrapping();
        \App\Http\Resources\Blog\CommentResource::withoutWrapping();
        \App\Http\Resources\Blog\PostResource::withoutWrapping();
        \App\Http\Resources\Blog\RoleResource::withoutWrapping();
        \App\Http\Resources\Blog\TagResource::withoutWrapping();
        \App\Http\Resources\Blog\UserResource::withoutWrapping();
    }
}
