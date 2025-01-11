<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// Route::get('/', function () {
//     return view('welcome');
// });

// route resource for products
Route::resource('/products', \App\Http\Controllers\ProductController::class);
Route::resource('/category', \App\Http\Controllers\CategoryController::class);
Route::resource('/satuan', \App\Http\Controllers\SatuanController::class);
Route::resource('/customer', \App\Http\Controllers\CustomerController::class);

Route::get('dashboard', [UserController::class, 'dashboard']);
Route::get('users', [UserController::class, 'users']);