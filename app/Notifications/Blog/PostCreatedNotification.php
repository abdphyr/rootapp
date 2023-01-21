<?php

namespace App\Notifications\Blog;

use App\Models\Blog\BlogPost;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PostCreatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public BlogPost $post;
    
    
    public function __construct(BlogPost $post)
    {
        $this->post = $post;
    }

    
    public function via($notifiable)
    {
        return ['database'];
    }

    
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    
    public function toArray($notifiable)
    {
        return [
            "id" => $this->post->id,
            "title" => $this->post->title,
            "created_at" => date('Y-m-d:m', strtotime($this->post->created_at)),
        ];
    }
}
