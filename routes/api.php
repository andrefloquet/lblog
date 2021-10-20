<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use Laravel\Sanctum\Http\Controllers\CsrfCookieController;

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

### Public Routes ###

// Testign


// Auth Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

### Protected Routes ###
Route::group(['middleware' => ['auth:sanctum']], function() {
    // Request user
    Route::post('/user', function (Request $request) { return auth()->user(); });
    
    // Auth Routes
    Route::post('/logout', [AuthController::class, 'logout']);

    // Category Routes
    Route::get('/categories', [CategoryController::class, 'index']);
	Route::post('/categories', [CategoryController::class, 'store']);
});