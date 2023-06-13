<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StatisticController;
use App\Http\Controllers\UserController;
use App\Models\Brand;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/shop', [HomeController::class, 'shop'])->name('shop');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/detail/{slug}', [HomeController::class, 'detail'])->name('detail');
Route::get('/login/google', [LoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('/login/google/callback', [LoginController::class, 'handleGoogleCallback'])->name('login.google.callback');

Auth::routes(['verify' => true]);

Route::middleware(['auth'])->group(function () {
    Route::prefix('user')->group(function () {
        Route::get('/create-password', [UserController::class, 'createPassword'])->name('create.password');
        Route::post('/create-password/save', [UserController::class, 'savePassword'])->name('create.password.save');
        Route::get('/profile', [UserController::class, 'profile'])->name('profile')->middleware('verified');
        Route::post('/profile/edit', [UserController::class, 'edit'])->name('profile.edit');
        Route::post('/profile/edit/password', [UserController::class, 'editPassword'])->name('profile.edit.password');
    });
});

// Admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [StatisticController::class, 'dashboard'])->name('admin.dashboard');

        Route::get('/order', [OrderController::class, 'index'])->name('admin.order.index');
        Route::get('/order/{id}', [OrderController::class, 'detail'])->name('admin.order.detail');

        Route::get('/brand', [BrandController::class, 'index'])->name('admin.brand.index');

        Route::get('/collection', [CollectionController::class, 'index'])->name('admin.collection.index');

        Route::get('/category', [CategoryController::class, 'index'])->name('admin.category.index');
    });
});
