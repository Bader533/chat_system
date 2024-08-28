<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BoardingController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\ConditionController;
use App\Http\Controllers\Api\ContactUsController;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\DurationAgreementController;
use App\Http\Controllers\Api\GlaEventController;
use App\Http\Controllers\Api\GlaTeamController;
use App\Http\Controllers\Api\GroupController;
use App\Http\Controllers\Api\PrivacyController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\RoomController;
use App\Http\Controllers\UserController;
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


Route::middleware('auth:api')->group(function () {

    Route::get('/home', [HomeController::class, 'index']);

    Route::get('/boarding', [BoardingController::class, 'index']);

    Route::get('/privacy', [PrivacyController::class, 'show']);

    Route::get('/condition', [ConditionController::class, 'show']);

    Route::get('/duration-agreement', [DurationAgreementController::class, 'show']);

    Route::post('/contact', [ContactUsController::class, 'store']);

    Route::get('/countries', [CountryController::class, 'index']);

    Route::get('/cities', [CityController::class, 'index']);

    Route::resource('/room', RoomController::class);

    Route::resource('/group', GroupController::class);

    // gla events
    Route::get('/gla-event', [GlaEventController::class, 'index']);
    Route::get('/gla-event/{id}', [GlaEventController::class, 'show']);
    // end gla events

    // gla teams
    Route::get('/gla-team', [GlaTeamController::class, 'index']);
    Route::get('/gla-team/{id}', [GlaTeamController::class, 'show']);
    // end gla teams


});
