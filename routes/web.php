<?php

use Illuminate\Support\Facades\Route;


Route::view('ecommerceapi', 'docs.ecommerceapi')->name('ecommerceapi');
Route::view('blogapi', 'docs.blogapi')->name('blogapi');
Route::view('/', 'welcome');
