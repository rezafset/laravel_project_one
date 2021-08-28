<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\UserController;
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
// For Dashboard
Route::get('/', [DashboardController::class, 'index']);
// For Product
Route::get('/products', [ProductController::class, 'index'])->name('admin.product');
Route::get('/products/create', [ProductController::class, 'create'])->name('admin.product.create');
Route::post('/products/create', [ProductController::class, 'store']);
Route::get('/products/show/{id}', [ProductController::class, 'show'])->name('admin.product.show');
Route::get('/products/edit/{id}', [ProductController::class, 'edit'])->name('admin.product.edit');
Route::post('/products/edit/{id}', [ProductController::class, 'update']);
Route::get('/products/delete/{id}', [ProductController::class, 'delete'])->name('admin.product.delete');
// For User
Route::get('/users', [UserController::class, 'index'])->name('admin.user');
Route::get('/users/create', [UserController::class, 'create'])->name('admin.user.create');
Route::post('/users/create', [UserController::class, 'store']);
Route::post('/users/show/{id}', [UserController::class, 'show'])->name('admin.user.show');
Route::post('/users/edit/{id}', [UserController::class, 'edit'])->name('admin.user.edit');
Route::post('/users/update/{id}', [UserController::class, 'update']);
Route::post('/users/delete/{id}', [UserController::class, 'delete'])->name('admin.user.delete');
