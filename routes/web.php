<?php

use App\Http\Controllers\BoardingController;
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

Route::resource('boarding', BoardingController::class);
Route::get('search/boarding', [BoardingController::class, 'search'])->name('search.boarding');
