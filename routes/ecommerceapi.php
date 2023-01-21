<?php

use App\Http\Controllers\Ecommerce\CategoryController;
use App\Http\Controllers\Ecommerce\CommentController;
use App\Http\Controllers\Ecommerce\AuthController;
use App\Http\Controllers\Ecommerce\ProductController;
use App\Http\Controllers\Ecommerce\TagController;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('ec_auth_jwt')->group(function () {
  Route::post('refreshToken', [AuthController::class, 'refreshToken']);
  Route::post('logout', [AuthController::class, 'logout']);
  Route::get('user', [AuthController::class, 'user']);
});

Route::resources([
  'categories' => CategoryController::class,
  'products' => ProductController::class,
  'comments' => CommentController::class,
  'tags' => TagController::class
]);
