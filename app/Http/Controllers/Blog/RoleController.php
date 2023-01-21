<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Http\Resources\Blog\RoleResource;
use App\Models\Blog\BlogRole;


class RoleController extends Controller
{
    public function index() {
        try {
            return RoleResource::collection(BlogRole::all());
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()]);
        }
    }
}
