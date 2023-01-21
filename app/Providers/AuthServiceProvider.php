<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        \App\Models\Ecommerce\Product::class => \App\Policies\Ecommerce\ProductPolicy::class,
        \App\Models\Ecommerce\Comment::class => \App\Policies\Ecommerce\CommentPolicy::class,
        \App\Models\Ecommerce\Tag::class => \App\Policies\Ecommerce\TagPolicy::class,
        \App\Models\Ecommerce\Category::class => \App\Policies\Ecommerce\CategoryPolicy::class,
        \App\Models\Blog\BlogPost::class => \App\Policies\Blog\PostPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
