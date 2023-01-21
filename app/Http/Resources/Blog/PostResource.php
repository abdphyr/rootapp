<?php

namespace App\Http\Resources\Blog;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{

    private static bool $collect = false;

    
    public static function posts($posts) {
        self::$collect = true;
        return self::collection($posts);
    }


    public static function post($post) {
        self::$collect = false;
        return new PostResource($post);
    }


    public function toArray($request)
    {
        if(self::$collect){
            return [
                "id" => $this->id,
                "title" => $this->title,
                "short_content" => $this->short_content,
                'public_photo' => $this->public_photo,
                "created_at" => date('Y-m-d', strtotime($this->created_at)),
                "category_name" => $this->blog_category->name,
                "tags" => TagResource::collection($this->tags),
            ];
        } else {
            return [
                "id" => $this->id,
                "user_id" => $this->blog_user_id,
                "category_id" => $this->blog_category_id,
                "title" => $this->title,
                "short_content" => $this->short_content,
                "content" => $this->content,
                'public_photo' => $this->public_photo,
                "created_at" => date('Y-m-d', strtotime($this->created_at)),
                "category" => new CategoryResource($this->blog_category),
                "tags" => TagResource::collection($this->tags),
                "user" => new UserResource($this->blog_user)
            ];
        }
    }
}
