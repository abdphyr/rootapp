<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Exceptions\BadRequestException;
use App\Http\Controllers\Exceptions\NotFoundException;
use App\Http\Resources\Ecommerce\UserResource;
use App\Models\Ecommerce\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
  public function login(Request $request): JsonResponse
  {
    try {
      $credentials = $request->only(['email', 'password']);
      $validator = validator($request->all(), [
        'email' => 'required|string|email|max:255',
        'password' => 'required|string|min:6',
      ]);
      if ($validator->fails()) {
        throw new BadRequestException($validator->errors());
      }
      if (!$token = Auth::guard('ec_users')->attempt($credentials)) {
        throw new NotFoundException('Invalid credentials');
      }
      $user = User::where('email', $request->email)->first();
    } catch (BadRequestException $e) {
      return response()->json($e->getError(), $e->getCode());
    } catch (JWTException $e) {
      return response()->json(['error' => 'Could not create token'], 500);
    } catch (NotFoundException $e) {
      return response()->json($e->getError(), $e->getCode());
    }
    $user = new UserResource($user);
    return response()->json(compact('token', 'user'));
  }

  public function register(Request $request): JsonResponse
  {
    try {
      $validator = validator($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6|confirmed',
        'phone' => 'nullable'
      ]);
      if ($validator->fails()) {
        throw new BadRequestException($validator->errors());
      }
      $user = User::create([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'password' => Hash::make($request->input('password')),
        'phone' => $request->input('phone')
      ]);
      $user->roles()->attach([3]);
      $token = Auth::guard('ec_users')->fromUser($user);
    } catch (BadRequestException $e) {
      return response()->json($e->getError(), $e->getCode());
    } catch (JWTException $e) {
      return response()->json(['error' => 'Could not create token'], 500);
    } catch (\Throwable $th) {
      return response()->json(['error' => $th->getMessage()], 500);
    }
    $user = new UserResource($user);
    return response()->json(compact('token', 'user'), 201);
  }

  public function logout(): JsonResponse
  {
    try {
      Auth::guard('ec_users')->invalidate();
    } catch (\Throwable $th) {
      return response()->json(['error' => $th->getMessage()], 500);
    }
    return response()->json(['message' => 'Successfully logged out']);
  }

  public function user(Request $request): JsonResponse
  {
    return response()->json(new UserResource($request->user()));
  }

  public function refreshToken(): JsonResponse
  {
    try {
      $refreshToken = Auth::guard('ec_users')->refresh();
    } catch (\Throwable $th) {
      return response()->json(['error' => $th->getMessage()], 500);
    }
    return response()->json(compact('refreshToken'));
  }
}
