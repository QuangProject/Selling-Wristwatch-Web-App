<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReceiverController;
use App\Http\Controllers\StatisticController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WatchCategoryController;
use App\Http\Controllers\WatchController;
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

Route::middleware(['count.cart'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/shop', [HomeController::class, 'shop'])->name('shop');
    Route::get('/about', [HomeController::class, 'about'])->name('about');
    Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
    Route::get('/detail/{id}', [HomeController::class, 'detail'])->name('detail');
    Route::get('/login/google', [LoginController::class, 'redirectToGoogle'])->name('login.google');
    Route::get('/login/google/callback', [LoginController::class, 'handleGoogleCallback'])->name('login.google.callback');
    Route::get('/login/facebook', [LoginController::class, 'redirectToFacebook'])->name('login.facebook');
    Route::get('/login/facebook/callback', [LoginController::class, 'handleFacebookCallback'])->name('login.facebook.callback');

    // Get brand image
    Route::get('/brand/image/{id}', [BrandController::class, 'getImage'])->name('brand.image');
    // Get watch image
    Route::get('/watch/image/{id}', [ImageController::class, 'getImage'])->name('watch.image.get');

    Auth::routes(['verify' => true]);

    Route::middleware(['auth'])->group(function () {
        Route::prefix('user')->group(function () {
            Route::get('/create-password', [UserController::class, 'createPassword'])->name('create.password');
            Route::post('/create-password/save', [UserController::class, 'savePassword'])->name('create.password.save');
            Route::get('/profile', [UserController::class, 'profile'])->name('profile')->middleware('verified');
            Route::post('/profile/edit', [UserController::class, 'edit'])->name('profile.edit');
            Route::post('/profile/edit/password', [UserController::class, 'editPassword'])->name('profile.edit.password');
            Route::get('/cart', [CartController::class, 'index'])->name('cart');
            Route::get('/payment', [PaymentController::class, 'index'])->name('payment');
            Route::get('/receiver', [ReceiverController::class, 'index'])->name('receiver');
            Route::get('/order-information', [UserController::class, 'orderInformation'])->name('order.information');
            Route::get('/purchase-history', [UserController::class, 'purchaseHistory'])->name('purchase.history');
            Route::get('/detail-information/{id}', [UserController::class, 'detailedInformation'])->name('detailed.information');
        });
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
        Route::get('/watch', [WatchController::class, 'index'])->name('admin.watch.index');
        Route::get('/watch/{id}/image', [ImageController::class, 'index'])->name('admin.watch.image');
        Route::get('/watch-category', [WatchCategoryController::class, 'index'])->name('admin.watchcategory.index');
        Route::get('/contact', [ContactController::class, 'index'])->name('admin.contact.index');
    });
});
