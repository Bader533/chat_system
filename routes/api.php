<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BoardingController;
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

// ============= Auth =============
Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'loginPersonal']);
});

Route::prefix('auth')->middleware('auth:api')->group(function () {
    Route::get('logout', [AuthController::class, 'logout']);
});
// ============= end Auth =============

Route::get('/boarding', [BoardingController::class, 'index']);
