<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[LoginController::class, 'login'])->name('login');
Route::post('actionlogin',[LoginController::class,'actionlogin'])->name('actionlogin');
Route::get('home',[HomeController::class,'index'])->name('home')->middleware('auth');
Route::get('actionlogout',[LoginController::class, 'actionlogout'])->name('actionlogout')->middleware('auth');

// route resource for products
Route::resource('/products', \App\Http\Controllers\ProductController::class);
Route::resource('/category', \App\Http\Controllers\CategoryController::class);
Route::resource('/satuan', \App\Http\Controllers\SatuanController::class);
Route::resource('/customer', \App\Http\Controllers\CustomerController::class);

Route::get('dashboard', [UserController::class, 'dashboard']);
Route::get('users', [UserController::class, 'users']);
Route::get('register', [UserController::class, 'index']);
Route::get('printuserpdf', [UserController::class, 'printPDF'])->name('printuser');
Route::get('printcategorypdf', [CategoryController::class, 'printCatPDF'])->name('printcategory');
Route::get('printproductpdf', [ProductController::class, 'printProductPDF'])->name('printproduct');
Route::get('printexcel', [UserController::class, 'userExcel'])->name('exceluser');