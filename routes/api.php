<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('auth')->group(function(){
    Route::post('login', [AuthController::class,'login']);
    Route::post('register', [AuthController::class,'register']);
});
Route::middleware('authTokenApi')->group(function(){
    Route::prefix('auth')->group(function(){
        Route::post('me', [AuthController::class,'me']);
        Route::post('logout',  [AuthController::class,'logout']);
        Route::post('refresh', [AuthController::class,'refresh']);
    });
    Route::resource('product',ProductController::class);   
    Route::resource('category',CategoryController::class);   
});
