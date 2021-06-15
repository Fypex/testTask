<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\Auth\AuthController;
use \App\Http\Controllers\ProductController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('signIn', [AuthController::class, 'signIn'])->name('login');
Route::post('signUp', [AuthController::class, 'signUp']);

Route::get('products', [ProductController::class, 'getProducts']);
Route::post('products/order', [ProductController::class, 'order']);
