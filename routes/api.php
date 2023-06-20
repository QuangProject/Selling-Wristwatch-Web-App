<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Category
Route::get('/categories', 'App\Http\Controllers\CategoryController@list');
Route::post('/categories', 'App\Http\Controllers\CategoryController@store');
Route::get('/categories/{id}', 'App\Http\Controllers\CategoryController@show');
Route::put('/categories/{id}', 'App\Http\Controllers\CategoryController@update');
Route::delete('/categories/{id}', 'App\Http\Controllers\CategoryController@destroy');

// Brand
Route::get('/brands', 'App\Http\Controllers\BrandController@list');
Route::post('/brands', 'App\Http\Controllers\BrandController@store');
Route::get('/brands/{id}', 'App\Http\Controllers\BrandController@show');
Route::put('/brands/{id}', 'App\Http\Controllers\BrandController@update');
Route::delete('/brands/{id}', 'App\Http\Controllers\BrandController@destroy');

// Collection
Route::get('/collections', 'App\Http\Controllers\CollectionController@list');
Route::post('/collections', 'App\Http\Controllers\CollectionController@store');
Route::get('/collections/{id}', 'App\Http\Controllers\CollectionController@show');
Route::put('/collections/{id}', 'App\Http\Controllers\CollectionController@update');
Route::delete('/collections/{id}', 'App\Http\Controllers\CollectionController@destroy');

// Watch
Route::get('/watches', 'App\Http\Controllers\WatchController@list');
Route::post('/watches', 'App\Http\Controllers\WatchController@store');
Route::get('/watches/{id}', 'App\Http\Controllers\WatchController@show');
Route::put('/watches/{id}', 'App\Http\Controllers\WatchController@update');
Route::delete('/watches/{id}', 'App\Http\Controllers\WatchController@destroy');

// Image
Route::get('/images/watch/{watchId}', 'App\Http\Controllers\ImageController@list');
Route::post('/images/watch/{watchId}', 'App\Http\Controllers\ImageController@store');
Route::get('/images/{id}', 'App\Http\Controllers\ImageController@show');
Route::put('/images/{id}', 'App\Http\Controllers\ImageController@update');
Route::delete('/images/{id}', 'App\Http\Controllers\ImageController@destroy');

// Watch Category
Route::get('/watch-categories', 'App\Http\Controllers\WatchCategoryController@list');
Route::post('/watch-categories', 'App\Http\Controllers\WatchCategoryController@store');
Route::get('/watch-categories/{id}', 'App\Http\Controllers\WatchCategoryController@show');
Route::put('/watch-categories/{id}', 'App\Http\Controllers\WatchCategoryController@update');
Route::delete('/watch-categories/{id}', 'App\Http\Controllers\WatchCategoryController@destroy');

// Contact
Route::get('/contacts', 'App\Http\Controllers\ContactController@list');
Route::post('/contacts', 'App\Http\Controllers\ContactController@store');
Route::get('/contacts/{id}', 'App\Http\Controllers\ContactController@show');
Route::put('/contacts/{id}', 'App\Http\Controllers\ContactController@update');
Route::delete('/contacts/{id}', 'App\Http\Controllers\ContactController@destroy');

// Search Suggestions
Route::get('/search-suggestions', 'App\Http\Controllers\SearchController@suggestions');
Route::get('/watch/search-suggestions', 'App\Http\Controllers\SearchController@watchSuggestions');
Route::get('/category/search-suggestions', 'App\Http\Controllers\SearchController@categorySuggestions');

// Send Mail
Route::post('/send-mail', 'App\Http\Controllers\MailController@sendMail');
Route::post('/reply-contact', 'App\Http\Controllers\MailController@replyContact');

// Cart
Route::get('/cart', 'App\Http\Controllers\CartController@list');
Route::post('/cart', 'App\Http\Controllers\CartController@store');
Route::get('/cart/{id}', 'App\Http\Controllers\CartController@show');
Route::put('/cart/{id}', 'App\Http\Controllers\CartController@update');
Route::delete('/cart/{id}', 'App\Http\Controllers\CartController@destroy');