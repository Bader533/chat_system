<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BoardingController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\ConditionController;
use App\Http\Controllers\Api\ContactUsController;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\DurationAgreementController;
use App\Http\Controllers\Api\FirebaseController;
use App\Http\Controllers\Api\FollowController;
use App\Http\Controllers\Api\GlaEventController;
use App\Http\Controllers\Api\GlaTeamController;
use App\Http\Controllers\Api\GroupController;
use App\Http\Controllers\Api\PrivacyController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\RoomController;
use App\Http\Controllers\Api\RoomTypeController;
use App\Http\Controllers\Api\SplashController;
use App\Http\Controllers\Api\UserController as ApiUserController;
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
    // Route::post('login', [FirebaseController::class, 'loginWithGoogle']);
});

Route::prefix('auth')->middleware('auth:api')->group(function () {
    Route::get('logout', [AuthController::class, 'logout']);
});
// ============= end Auth =============

// splash route
Route::get('/check', [SplashController::class, 'check']);
Route::get('/check-maintenance', [SplashController::class, 'checkApp']);
// end splash

Route::get('/boarding', [BoardingController::class, 'index']);

Route::middleware('auth:api')->group(function () {

    Route::prefix('home')->group(function () {
        Route::get('/agency', [HomeController::class, 'agency']);
        Route::get('/ads', [HomeController::class, 'ads']);
        Route::get('/countries', [HomeController::class, 'countries']);
        Route::get('/rooms', [HomeController::class, 'rooms']);
    });

    Route::get('/privacy', [PrivacyController::class, 'show']);

    Route::get('/condition', [ConditionController::class, 'show']);

    Route::get('/duration-agreement', [DurationAgreementController::class, 'show']);

    Route::post('/contact', [ContactUsController::class, 'store']);

    Route::prefix('countries')->group(function () {
        Route::get('/', [CountryController::class, 'index']);
        Route::get('/{id}/rooms', [CountryController::class, 'show']);
    });

    Route::get('/cities', [CityController::class, 'index']);

    //room
    Route::resource('/room', RoomController::class);
    Route::get('/search/room', [RoomController::class, 'search']);
    Route::get('/favorite/room', [RoomController::class, 'favorite']);
    Route::get('/add-favorite/room', [RoomController::class, 'setFavoriteRoom']);
    Route::get('/room-type', [RoomTypeController::class, 'index']);
    //end room

    Route::resource('/group', GroupController::class);

    // gla events
    Route::get('/gla-event', [GlaEventController::class, 'index']);
    Route::get('/gla-event/{id}', [GlaEventController::class, 'show']);
    // end gla events

    // gla teams
    Route::get('/gla-team', [GlaTeamController::class, 'index']);
    Route::get('/gla-team/{id}', [GlaTeamController::class, 'show']);
    // end gla teams

    // user
    Route::get('/user', [ApiUserController::class, 'show']);
    Route::get('/search/user', [ApiUserController::class, 'search']);
    Route::get('/follow/user', [ApiUserController::class, 'follow']);
    // end user

    // follow
    Route::get('/follow', [FollowController::class, 'index']);
    // end follow

    // posts
    Route::get('/posts', [PostController::class, 'index']);
    Route::get('/my-posts', [PostController::class, 'myPost']);
    Route::post('/posts', [PostController::class, 'store']);
    Route::post('/posts/{id}', [PostController::class, 'update']);
    Route::delete('/posts/{id}', [PostController::class, 'destroy']);

    Route::get('/post/like/{id}', [PostController::class, 'like']);
    Route::post('/post/comment/{id}', [PostController::class, 'comment']);
    Route::get('/post/comment/{id}', [PostController::class, 'getPostComment']);

    // end posts
});
