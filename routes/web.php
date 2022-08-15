<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\Rooms;
use App\Http\Controllers\RoomsMaster;
use App\Http\Controllers\CheckinMaster;
use App\Http\Controllers\StoreMaster;
use App\Http\Controllers\GuestMaster;
use App\Http\Controllers\VisitMaster;
use App\Http\Controllers\PrintMaster;
use App\Http\Controllers\Guests;
use App\Http\Controllers\IVault;
use App\Http\Controllers\LiveSearch;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('dashboard');
});

/////////////////////Misc//////////////////////////////////////
Route::get('/configs', [Preferences::class, 'GetAllConfigs']);
Route::get('/print-slips', [PrintMaster::class, 'PrintSlips']);
////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////
Route::get('/login', [CustomAuthController::class, 'Login'])->middleware('issesshasval');
Route::get('/registeration', [CustomAuthController::class, 'Registeration']);
Route::post('/register-user', [CustomAuthController::class, 'RegisterUser'])->name('register-user')->middleware('isLogedIn');
Route::post('/user-login', [CustomAuthController::class, 'UserLogin'])->name('user-login');
Route::get('/logout', [CustomAuthController::class, 'Logout'])->name('logout');
Route::get('/dashboard', [CustomAuthController::class, 'dashboard'])->middleware('isLogedIn');
Route::get('/test', [CustomAuthController::class, 'Test']);
///////////////////////////////////////////////////////////////////////////////////
///////////////////ROOMS//////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
Route::get('/addroom', [RoomsMaster::class, 'AddRoom']);
Route::post('/create-room', [RoomsMaster::class, 'CreateRoom'])->name('create-room')->middleware('isLogedIn');
Route::get('/changerent', [RoomsMaster::class, 'ChangeRent']);
Route::post('/update-rent', [RoomsMaster::class, 'UpdateRent'])->name('update-rent')->middleware('isLogedIn');
Route::get('/get-all-rooms', [RoomsMaster::class, 'GetVacantRooms']);
//Route::get('/get-all-rooms?satatus={status?}&roomno={roomno?}&type={type?}&groupby={groupby?}', [RoomsMaster::class, 'GetVacantRooms']);
///////////////////////////////////////////////////////////////////////////////////
///////////////////GUESTS//////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
Route::post('/create-guest', [GuestMaster::class, 'CreateGuest'])->name('create-guest')->middleware('isLogedIn');
Route::post('/create-sec-guest', [GuestMaster::class, 'CreateSecondGuest'])->name('create-sec-guest')->middleware('isLogedIn');
Route::get('/editidv/{id?}', [GuestMaster::class, 'EditIDV']);
Route::post('/updateidv', [GuestMaster::class, 'UpdateIDV'])->name('updateidv')->middleware('isLogedIn');
////////////////////////////////Checkin/////////////////////////////////////
Route::get('/checkin/{id?}', [CheckinMaster::class, 'ChekinMain']);
Route::post('/guest-checkin', [CheckinMaster::class, 'GuestCheckin'])->name('guest-checkin')->middleware('isLogedIn');
///////////////////////////////////////////////////////////////////////////////////
///////////////////STORE//////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
Route::get('/add-stock-category', [StoreMaster::class, 'AddStockCat']);
Route::get('/add-Location-vendor', [StoreMaster::class, 'AddLocationVendor']);
Route::get('/add-stock-asset', [StoreMaster::class, 'AddStockAsset']);
Route::post('/add-location', [StoreMaster::class, 'AddLocation'])->name('add-location')->middleware('isLogedIn');
Route::post('/add-vendor', [StoreMaster::class, 'AddVendor'])->name('add-vendor')->middleware('isLogedIn');
Route::post('/add-location', [StoreMaster::class, 'AddLocation'])->name('add-location')->middleware('isLogedIn');
Route::post('/add-category', [StoreMaster::class, 'AddCategory'])->name('add-category')->middleware('isLogedIn');
Route::post('/add-new-asset', [StoreMaster::class, 'AddNewAsset'])->name('add-new-asset')->middleware('isLogedIn');
Route::get('/store-beddings', [StoreMaster::class, 'StoreBedding']);
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////Visits/////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
Route::post('/visit-entry', [VisitMaster::class, 'VisitEntry'])->name('visit-entry')->middleware('isLogedIn');
Route::get('/get-visit-details', [VisitMaster::class, 'GetVisitDetails']);

///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////Live Search/////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
Route::get('/guest-details', [LiveSearch::class, 'GetGuestDetails']);
Route::get('/guest-phone', [LiveSearch::class, 'GetGuestPhone']);

