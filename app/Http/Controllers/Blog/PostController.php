<?php

namespace App\Http\Controllers\Blog;

use App\Events\Blog\PostCreated;
use App\Http\Controllers\Controller;
use App\Models\Blog\BlogPost;
use Illuminate\Http\Request;
use App\Http\Requests\Blog\StorePostRequest;
use App\Http\Resources\Blog\PostResource;
use App\Jobs\Blog\ChangePostJob;
use App\Jobs\Blog\PostCacheJob;
use App\Mail\Blog\PostCreatedMail;
use App\Notifications\Blog\PostCreatedNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
  public function __construct()
  {
    $this->middleware("auth:sanctum")->except(['index', 'show', 'latest']);
  }

  public function index()
  {
    try {
      return PostResource::posts(BlogPost::latest()->paginate(5));
    } catch (\Throwable $th) {
      return response()->json(['error' => $th->getMessage()], 500);
    }
  }

  public function show($id)
  {
    try {
      return PostResource::post(BlogPost::find($id));
    } catch (\Throwable $th) {
      return response()->json(['error' => $th->getMessage()], 500);
    }
  }

  public function store(Request $request)
  {
    try {
      $validator = validator($request->all(), [
        'category_id' => 'nullable',
        'title' => 'required|max:255',
        'short_content' => 'required',
        'content' => 'required',
        'photo' => 'nullable|mimes:png,jpg,jpeg|max:2048',
        'tags' => 'string'
      ]);
      if ($validator->fails()) {
        return response()->json($validator->errors(), 400);
      }
      if ($request->hasFile('photo')) {
        $inner_photo = $request->file('photo')->store('post-photos');
        $public_photo = asset('storage/' . $inner_photo);
      }

      $newPost = BlogPost::create([
        "blog_user_id" => auth()->user()->id,
        "blog_category_id" => $request->category_id,
        "title" => $request->title,
        "short_content" => $request->short_content,
        "content" => $request->content,
        'public_photo' => $public_photo ?? asset('storage/post-photos/Laravel.jpg'),
        'inner_photo' => $inner_photo ?? asset('storage/post-photos/Laravel.jpg'),
      ]);

      $newPost->tags()->attach(json_decode($request->tags, true));

      PostCreated::dispatch($newPost);
      PostCacheJob::dispatch();
      ChangePostJob::dispatch($newPost)->delay(10);
      Mail::to(auth()->user())->queue((new PostCreatedMail($newPost))->delay(10));
      Notification::send(auth()->user(), (new PostCreatedNotification($newPost))->delay(10));

      return response()->json(PostResource::post($newPost));
    } catch (\Throwable $th) {
      return response()->json(['error' => $th->getMessage()], 500);
    }
  }

  public function update(Request $request, $id)
  {
    try {
      $post = BlogPost::find($id);

      $this->authorize('update', $post);

      $post->update([
        "title" => $request->title ?? $post->title,
        "short_content" => $request->short_content ?? $post->short_content,
        "content" => $request->content ?? $post->content,
      ]);
      return response()->json(PostResource::post($post));
    } catch (\Throwable $th) {
      return response()->json(['error' => $th->getMessage()], 500);
    }
  }

  public function destroy($id)
  {
    try {
      $post = BlogPost::find($id);

      $this->authorize('delete', $post);

      if ($post->inner_photo) {
        Storage::delete($post->inner_photo);
      }
      $post->tags()->detach();
      $post->comments()->delete();
      $post->delete();
      return response()->json(PostResource::post($post));
    } catch (\Throwable $th) {
      return response()->json(['error' => $th->getMessage()], 500);
    }
  }

  public function latest($id)
  {
    try {
      $latest_posts = BlogPost::latest()->get()->except($id)->take(5);
      return PostResource::posts($latest_posts);
    } catch (\Throwable $th) {
      return response()->json(['error' => $th->getMessage()], 500);
    }
  }
}
