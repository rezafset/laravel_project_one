<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ProductController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', [DashboardController::class, 'index']);
// Route::get('/test', [DashboardController::class, 'test']);
Route::get('/', [DashboardController::class, 'index']);
Route::get('/products', [ProductController::class, 'index'])->name('admin.product');
Route::get('/products/create', [ProductController::class, 'create'])->name('admin.product.create');
Route::post('/products/create', [ProductController::class, 'store']);
