<?php

namespace App\Http\Resources\Blog;

use Illuminate\Http\Resources\Json\JsonResource;

class TagResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "tag_name" => $this->tag_name,
        ];
    }
}
