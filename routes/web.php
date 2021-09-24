<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\LoginController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CustomerController;
use App\Http\Controllers\Frontend\HomeController;
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

// Frontend
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/register', [CustomerController::class, 'register'])->name('customer.register');
Route::post('/register', [CustomerController::class, 'doRegister']);


// Login
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
// Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
// Cart
Route::get('/add/cart/{id}', [CartController::class, 'cart'])->name('add.cart');
Route::get('/cart', [CartController::class, 'show_cart'])->name('cart');

Route::middleware('auth')->group(function () {
    Route::get('/customerProfile', [CustomerController::class, 'customerProfile'])->name('customer.profile');
    Route::get('/editCustomer', [CustomerController::class, 'editCustomer'])->name('customer.edit');
    Route::post('/editCustomer', [CustomerController::class, 'updateCustomer']);
    Route::get('/customerPassword', [CustomerController::class, 'password'])->name('customer.password');
    Route::post('/customerPassword', [CustomerController::class, 'passwordChange']);
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


    Route::middleware('isAdmin')->group(function () {

        Route::prefix('dashboard')->group(function () {
            // For Dashboard
            Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

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
            Route::get('/users/show/{id}', [UserController::class, 'show'])->name('admin.user.show');
            Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('admin.user.edit');
            Route::post('/users/edit/{id}', [UserController::class, 'update']);
            Route::get('/users/delete/{id}', [UserController::class, 'delete'])->name('admin.user.delete');
            Route::get('/user/profile', [UserController::class, 'profile'])->name('profile');
            Route::post('/user/profile', [UserController::class, 'profileUpdate']);
            Route::get('/user/password', [UserController::class, 'password'])->name('user.password');
            Route::post('/user/password', [UserController::class, 'changePassword']);

        });
    });
});
