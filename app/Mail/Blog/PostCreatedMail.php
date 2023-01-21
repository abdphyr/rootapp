<?php

namespace App\Mail\Blog;

use App\Models\Blog\BlogPost;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PostCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public BlogPost $post;
    

    public function __construct(BlogPost $post)
    {
        $this->post = $post;
    }

    
    public function envelope()
    {
        return new Envelope(
            subject: 'Post Created Mail \n',
        );
    }

    
    public function content()
    {
        return new Content(
            view: 'mails.post-created',
        );
    }

    
    public function attachments()
    {
        return [];
    }
}
