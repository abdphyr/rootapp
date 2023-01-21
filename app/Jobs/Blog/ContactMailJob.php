<?php

namespace App\Jobs\Blog;

use App\Mail\Blog\ContactMail;
use App\Models\Blog\BlogMessage;
use App\Models\Blog\BlogUser;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ContactMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public BlogMessage $message;

    public function __construct(BlogMessage $message)
    {
        $this->message = $message;
    }

    public function handle()
    {
        $admin = BlogUser::first();
        Mail::to($admin)->send(new ContactMail($this->message));
    }
}
