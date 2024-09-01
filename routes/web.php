<?php

use App\Http\Controllers\back\CategoryController;
use App\Http\Controllers\back\DashboardController;
use App\Http\Controllers\back\ProductController;
use App\Http\Controllers\front\FrontController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/',[FrontController::class,'index']);
Auth::routes();

Route::get('/home', [DashboardController::class, 'index'])->name('home');


// BackEnd Route Start
// Product
Route::get('admin/product',[ProductController::class,'index'])->name('admin.product');


// Category

Route::get('admin/category',[CategoryController::class,'index'])->name('admin.category');
Route::post('admin/category/save',[CategoryController::class,'store'])->name('admin.category.save');

// BackEnd Route End
