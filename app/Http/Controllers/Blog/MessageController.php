<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Jobs\Blog\ContactMailJob;
use App\Models\Blog\BlogMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    public function index()
    {
        try {
            return BlogMessage::all();
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()]);
        }
    }
    public function store(Request $request)
    {
        try {
            $contactMessage = Validator::make(
                $request->all(),
                [
                    'name' => 'required',
                    'email' => 'required|email',
                    'subject' => 'required|string',
                    'message' => 'required|string'
                ]
            );
            if ($contactMessage->fails()) return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $contactMessage->errors()
            ], 401);


            $message = BlogMessage::create([
                'name' => $request->name,
                'email' => $request->email,
                'subject' => $request->subject,
                'message' => $request->message
            ]);

            ContactMailJob::dispatch($message);
            return $message;
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()]);
        }
    }
}
