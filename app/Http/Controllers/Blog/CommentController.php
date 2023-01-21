<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Http\Resources\Blog\CommentResource;
use App\Models\Blog\BlogComment;
use App\Models\Blog\BlogPost;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth:sanctum")->except(['index']);
    }


    public function index(Request $request)
    {
        try {
            $post = BlogPost::find($request->post_id);
            return [
                "comments" => CommentResource::collection($post->comments),
                "count" => $post->comments()->count()
            ];
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()]);
        }
    }


    public function store(Request $request)
    {
        try {
            $newComment = BlogComment::create([
                "blog_user_id" => auth()->user()->id,
                "blog_post_id" => $request->post_id,
                "body" => $request->body
            ]);
            return $newComment;
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()]);
        }
    }
}
