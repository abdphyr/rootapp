<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Http\Resources\Blog\TagResource;
use App\Models\Blog\BlogTag;

class TagController extends Controller
{
    public function index()
    {
        try {
            return TagResource::collection(BlogTag::all());
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()]);
        }
    }
}