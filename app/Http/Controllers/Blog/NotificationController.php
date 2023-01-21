<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth:sanctum");
    }


    public function index()
    {
        try {
            return [
                "count" => auth()->user()->unreadNotifications()->count(),
                "notifications" =>auth()->user()->notifications
            ];  
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
    }


    public function read($id)
    {
        try {
            auth()->user()->notifications()->find($id)->markAsRead();
            return $id;
        } catch (\Throwable $th ) {
            return response()->json(['error' => $th->getMessage()]);
        }
    }

    public function readAll()
    {
        try {
            auth()->user()->notifications->markAsRead();
            return response()->json(["message" => "Success"]);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
    }


    public function destroy($id)
    {
        try {
            auth()->user()->notifications()->find($id)->delete();
            return response()->json(["message" => "Success"]);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
    }


    public function destroyAll()
    {
        try {
            auth()->user()->notifications()->delete();
            return response()->json(["message" => "Success"]);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
    }
}
