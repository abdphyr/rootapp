<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Http\Resources\Blog\CategoryResource;
use App\Models\Blog\BlogCategory;

class CategoryController extends Controller
{
    public function index()
    {
        try {
            return CategoryResource::collection(BlogCategory::all());
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()]);
        }
    }
}
