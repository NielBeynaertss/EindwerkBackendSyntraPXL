<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ListingController;

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
    return view('welcome');
});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::controller(LoginRegisterController::class)->group(function() {
    Route::get('/register', 'register')->name('register');
    Route::post('/storeNewMember', 'storeNewMember')->name('storeNewMember');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::post('/logout', 'logout')->name('logout');
});


Route::get('/settings', [SettingsController::class, 'showSettingsPage'])->name('settings');


Route::get('/marketplace', [ListingController::class, 'showMarketplacePage'])->name('marketplace');
Route::post('/storeListing', [ListingController::class, 'storeListing'])->name('storeListing');

Route::get('/listing/{id}', [ListingController::class, 'showListingDetails'])->name('listingDetail');

Route::post('/add-to-favorites', [ListingController::class, 'addToFavorites'])->name('addToFavorites');
Route::get('/marketplace/clear', [ListingController::class, 'clearFilters'])->name('clearFilters');
