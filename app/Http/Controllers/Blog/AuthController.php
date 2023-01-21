<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Blog\AuthRequest;
use App\Http\Resources\Blog\UserResource;
use Illuminate\Http\Request;
use App\Models\Blog\BlogUser;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = AuthRequest::loginValidate($request);
        if ($validator['form']) return $validator['formError'];

        try {
            $user = BlogUser::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            $user->roles()->attach(3);

            return response()->json([
                'user' => new UserResource($user),
                'status' => true,
                'message' => 'User Created Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }


    public function login(Request $request)
    {
        $validator = AuthRequest::loginValidate($request);
        if ($validator['form']) return $validator['formError'];
        if ($validator['attempt']) return $validator['attemptError'];

        try {
            $user = BlogUser::where('email', $request->email)->first();

            return response()->json([
                'user' => new UserResource($user),
                'status' => true,
                'message' => 'User Logged In Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function confirm_password(Request $request)
    {
        if (!Hash::check($request->password, $request->user()->password)) {
            return response()->json([
                'error' => ['The provided password does\'nt match']
            ], 500);
        } else {
            return response()->json([
                'message' => "Ok"
            ]);
        }
    }
}
