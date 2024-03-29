<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ForumController;


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
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::get('/login', 'login')->name('login');

    Route::post('/storeNewMember', 'storeNewMember')->name('storeNewMember');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::post('/logout', 'logout')->name('logout');

    Route::get('/password/reset', 'showForgotPasswordPage')->name('password.request');
    Route::post('/password/email', 'forgotPassword')->name('password.email');
    Route::get('/password/reset/{token}', 'showResetForm')->name('password.reset');
    Route::post('/password/reset', 'resetPassword')->name('password.update');
    
});
Route::controller(ListingController::class)->group(function() {
    Route::get('/marketplace', 'showMarketplacePage')->name('marketplace');
    Route::get('/listing/{id}', 'showListingDetails')->name('listingDetail');
    Route::get('/marketplace/clear', 'clearFilters')->name('clearFilters');
    Route::post('/storeListing', 'storeListing')->name('storeListing');
    Route::post('/addListingToFavorites', 'addListingToFavorites')->name('addListingToFavorites');
});
Route::controller(SettingsController::class)->group(function() {
    Route::get('/settings', 'showSettingsPage')->name('settings');
    Route::post('/updateProfilePicture', 'updateProfilePicture')->name('updateProfilePicture');
    Route::post('/updatePassword', 'updatePassword')->name('updatePassword');
    Route::post('/updateCredentials', 'updateCredentials')->name('updateCredentials');
    Route::post('/settings', 'updateCredentials')->name('updateCredentials');
});
Route::controller(EventController::class)->group(function() {
    Route::get('/events', 'showEventsPage')->name('events');
    Route::get('/event/{id}', 'showEventDetails')->name('eventDetail');
    Route::post('/storeEvent', 'storeEvent')->name('storeEvent');
    Route::post('/addEventToFavorites', 'addEventToFavorites')->name('addEventToFavorites');
});
Route::controller(ForumController::class)->group(function() {
    Route::get('/forum', 'showForumPage')->name('forum');
});