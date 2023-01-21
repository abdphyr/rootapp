<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Blog\AuthController;
use App\Http\Controllers\Blog\CommentController;
use App\Http\Controllers\Blog\PostController;
use App\Http\Controllers\Blog\CategoryController;
use App\Http\Controllers\Blog\MessageController;
use App\Http\Controllers\Blog\NotificationController;
use App\Http\Controllers\Blog\RoleController;
use App\Http\Controllers\Blog\TagController;
use App\Http\Resources\Blog\UserResource;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  return new UserResource($request->user());
});

Route::get('notauth', function () {
  return response()->json(['error' => "Unauthorized"]);
})->name('notauth');

Route::middleware("throttle:5")->group(function () {
  Route::post('/register', [AuthController::class, 'register']);
  Route::post('/login', [AuthController::class, 'login']);
  Route::post('/confirm-password', [AuthController::class, 'confirm_password'])
    ->middleware(["auth:sanctum"]);
});

Route::get('/notifications/{id}/read', [NotificationController::class, 'read']);
Route::get('/notifications/readall', [NotificationController::class, 'readAll']);
Route::delete('/notifications/deleteall', [NotificationController::class, 'destroyAll']);

Route::get('/posts/latest/{id}', [PostController::class, 'latest']);


Route::resources([
  '/posts' => PostController::class,
  '/comments' => CommentController::class,
  '/categories' => CategoryController::class,
  '/tags' => TagController::class,
  '/notifications' => NotificationController::class,
  "/roles" => RoleController::class,
  '/messages' => MessageController::class
]);
