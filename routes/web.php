<?php

use App\Http\Controllers\BoardingController;
use App\Http\Controllers\ConditionController;
use App\Http\Controllers\DurationAgreementController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PrivacyController;
use App\Http\Controllers\UserController;
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

Route::get('home', function () {
    return view('dashboard.parent');
})->name('home');

// borading
Route::resource('boarding', BoardingController::class);
Route::get('search/boarding', [BoardingController::class, 'search'])->name('search.boarding');
//end borading

// users
Route::get('/user', [UserController::class, 'index'])->name('user.index');
Route::get('/getuser', [UserController::class, 'getUser'])->name('user.data');
//end users

// privacy
Route::resource('/privacy', PrivacyController::class);
//end privacy

// condition
Route::resource('/condition', ConditionController::class);
//end condition

// condition
Route::resource('/duration-agreement', DurationAgreementController::class);
//end condition
