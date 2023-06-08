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
Route::get('/categories', 'App\Http\Controllers\CategoryController@index');
Route::post('/categories', 'App\Http\Controllers\CategoryController@store');
Route::get('/categories/{id}', 'App\Http\Controllers\CategoryController@show');
Route::put('/categories/{id}', 'App\Http\Controllers\CategoryController@update');
Route::delete('/categories/{id}', 'App\Http\Controllers\CategoryController@destroy');

// Brand
Route::get('/brands', 'App\Http\Controllers\BrandController@index');
Route::get('/brands/image/{id}', 'App\Http\Controllers\BrandController@getImage');
Route::post('/brands', 'App\Http\Controllers\BrandController@store');
Route::get('/brands/{id}', 'App\Http\Controllers\BrandController@show');
Route::put('/brands/{id}', 'App\Http\Controllers\BrandController@update');
Route::delete('/brands/{id}', 'App\Http\Controllers\BrandController@destroy');

// Collection
Route::get('/collections', 'App\Http\Controllers\CollectionController@index');
Route::post('/collections', 'App\Http\Controllers\CollectionController@store');
Route::get('/collections/{id}', 'App\Http\Controllers\CollectionController@show');
Route::put('/collections/{id}', 'App\Http\Controllers\CollectionController@update');
Route::delete('/collections/{id}', 'App\Http\Controllers\CollectionController@destroy');

// Watch
Route::get('/watches', 'App\Http\Controllers\WatchController@index');
Route::post('/watches', 'App\Http\Controllers\WatchController@store');
Route::get('/watches/{id}', 'App\Http\Controllers\WatchController@show');
Route::put('/watches/{id}', 'App\Http\Controllers\WatchController@update');
Route::delete('/watches/{id}', 'App\Http\Controllers\WatchController@destroy');

// Category Watch
Route::get('/category-watches', 'App\Http\Controllers\CategoryWatchController@index');
Route::post('/category-watches', 'App\Http\Controllers\CategoryWatchController@store');
Route::get('/category-watches/{id}', 'App\Http\Controllers\CategoryWatchController@show');
Route::put('/category-watches/{id}', 'App\Http\Controllers\CategoryWatchController@update');
Route::delete('/category-watches/{id}', 'App\Http\Controllers\CategoryWatchController@destroy');