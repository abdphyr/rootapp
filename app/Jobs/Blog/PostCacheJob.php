<?php

namespace App\Jobs\Blog;

use App\Http\Resources\Blog\PostResource;
use App\Models\Blog\BlogPost;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
// use Illuminate\Support\Facades\Redis;

class PostCacheJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    
    public function __construct()
    {
        //
    }

    
    public function handle()
    {
        $posts =  PostResource::posts(BlogPost::latest()->paginate(5));
        // Redis::set('posts', json_encode($posts));
    }
}
