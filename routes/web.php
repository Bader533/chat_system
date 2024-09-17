<?php

use App\Http\Controllers\AdsController;
use App\Http\Controllers\AgencyController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorizationController;
use App\Http\Controllers\BoardingController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ConditionController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\DurationAgreementController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\GlaEventController;
use App\Http\Controllers\GlaTeamController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PrivacyController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomTypeController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WalletController;
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

Route::get('/', function () {
    return redirect()->route('login');
});

// ==================================== login ====================================
Route::get('login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('login', [AuthController::class, 'Login'])->middleware('guest');
// ==================================== end login ====================================

Route::middleware('auth:web')->group(
    function () {

        Route::get('/', [HomeController::class, 'index'])->name('home');

        // borading
        Route::resource('boarding', BoardingController::class);
        Route::get('search/boarding', [BoardingController::class, 'search'])->name('search.boarding');
        //end borading

        // users
        Route::get('/user', [UserController::class, 'index'])->name('user.index');
        Route::get('/user/{id}', [UserController::class, 'show'])->name('user.show');
        Route::get('/getuser', [UserController::class, 'getUser'])->name('user.data');
        Route::get('/getdata', [UserController::class, 'getData']);
        Route::get('/status/user', [UserController::class, 'changeStatus'])->name('user.status');
        //end users

        // employee
        Route::resource('/employee', EmployeeController::class);
        Route::get('/getEmployee', [EmployeeController::class, 'getEmplyees'])->name('employee.data');
        Route::get('/status/employee', [EmployeeController::class, 'changeStatus'])->name('employee.status');
        //end employee

        // privacy
        Route::resource('/privacy', PrivacyController::class);
        //end privacy

        // condition
        Route::resource('/condition', ConditionController::class);
        //end condition

        // condition
        Route::resource('/duration-agreement', DurationAgreementController::class);
        //end condition

        // contact
        Route::resource('/contact', ContactUsController::class);
        Route::get('/getContact', [ContactUsController::class, 'getContact'])->name('contact.data');
        //end contact

        // contact
        Route::resource('/ads', AdsController::class);
        Route::get('/getAds', [AdsController::class, 'getAds'])->name('ads.data');
        //end contact

        // country
        Route::resource('/country', CountryController::class);
        Route::get('/getCountry', [CountryController::class, 'getCountries'])->name('country.data');
        //end country

        // city
        Route::resource('/city', CityController::class);
        Route::get('/getCity', [CityController::class, 'getCities'])->name('city.data');
        //end city

        // room-type
        Route::resource('/roomtype', RoomTypeController::class);
        Route::get('/getRoomType', [RoomTypeController::class, 'getRoomTpyes'])->name('roomtype.data');
        //end room-type

        // room
        Route::get('/room/{kind?}', [RoomController::class, 'index'])->name('room.index');
        Route::get('/status/room', [RoomController::class, 'changeStatus'])->name('room.status');
        Route::get('/home/room', [RoomController::class, 'changeIsHome'])->name('room.home');
        Route::get('/favorite/room', [RoomController::class, 'changeIsFavorite'])->name('room.favorite');
        Route::get('/getRoom', [RoomController::class, 'getRooms'])->name('room.data');
        //end room

        // group
        Route::get('/group', [GroupController::class, 'index'])->name('group.index');
        Route::get('/getGroup', [GroupController::class, 'getGroups'])->name('group.data');
        Route::get('/status/group', [GroupController::class, 'changeStatus'])->name('group.status');
        //end group

        // gla-event
        Route::resource('/gla-event', GlaEventController::class);
        Route::get('/getEvent', [GlaEventController::class, 'getEvents'])->name('event.data');
        //end gla-event

        // gla-team
        Route::resource('/gla-team', GlaTeamController::class);
        Route::get('/getTeam', [GlaTeamController::class, 'getTeams'])->name('team.data');
        //end gla-team

        // agency
        Route::resource('/agency', AgencyController::class);
        Route::get('/getAgency', [AgencyController::class, 'getAgencies'])->name('agency.data');
        Route::get('/getData', [AgencyController::class, 'getData']);
        //end agency

        // wallet
        Route::resource('/wallet', WalletController::class);
        Route::get('/getWallet', [WalletController::class, 'getWallets'])->name('wallet.data');
        //end wallet

        // settings
        Route::get('/settings/create', [SettingsController::class, 'create']);
        Route::post('/settings', [SettingsController::class, 'store']);
        //end settings

        // post
        Route::resource('/post', PostController::class);
        Route::get('/getPost', [PostController::class, 'getPost'])->name('post.data');
        Route::get('/status/post', [PostController::class, 'changeStatus'])->name('post.status');
        //end post

        // rule & permission
        Route::get('/rule', [AuthorizationController::class, 'Rules'])->name('rule.index');
        Route::get('/getrule', [AuthorizationController::class, 'getRules']);
        Route::get('/permission', [AuthorizationController::class, 'Permissions'])->name('permission.index');
        Route::get('/getpermission', [AuthorizationController::class, 'getPermissions']);
        //end rule & permission

        // logout
        Route::get('logout', [AuthController::class, 'logout'])->name('logout');
        // end logout

    }
);
