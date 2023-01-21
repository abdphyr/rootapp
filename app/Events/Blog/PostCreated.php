<?php

namespace App\Events\Blog;

use App\Models\Blog\BlogPost;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PostCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public BlogPost $post;
   
    public function __construct(BlogPost $post)
    {
        $this->post = $post;
    }

     
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
