<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TransactionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('product-search', [ProductController::class, 'search']);
Route::get('blog-search', [BlogController::class, 'search']);
Route::get('category-search', [CategoryController::class, 'search']);
Route::get('user-search', [UserController::class, 'search']);
Route::get('transaction-search', [TransactionController::class, 'search']);

Route::get('/{any}', [ApplicationController::class, 'index'])->where('any', '.*');

