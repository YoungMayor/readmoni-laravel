<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Providers\RouteServiceProvider as RSP;
use Illuminate\Support\Facades\Request;

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


/**
 * Profile Pages
 */    
Route::get("/profile", "UserProfileController@showProfile")->name("user.profile.page");

Route::get("/edit-profile", "UserProfileController@showProfileEditor")->name("user.profile.edit.page")->middleware(['password.confirm']);        


/**
 * User Activities
 */
Route::get("/dashboard", "DashBoardController@showPage")->name("user.dashboard.page");

Route::get("/notifications", "UserNotificationController@showPage")->name("user.notifications.page");

Route::get("/news", "NewsController@showNewsPage")->name("user.news.page");

Route::post('load_news', 'NewsController@loadNews')->name('user.news.load');

Route::get('/view_news@{hash}', 'NewsController@viewNews')->name('user.news.view');

Route::get('/request_payout', 'PayoutController@request')->name('user.payout.request');


/**
 * Notification Processes
 */

Route::post('/alert_center', "UserNotificationController@recentNotifs")->name('user.alert_center.process');

Route::post('/get_notifications', "UserNotificationController@getNotifs")->name('user.notifications.process');



/**
 * Profile Edit Processes
 */
Route::post('/change_avatar', 'UserProfileController@changeAvatar')->name('user.profile.edit.avatar');

Route::post('/edit_nick', 'UserProfileController@updateNick')->name('user.profile.edit.nick');
Route::post('/edit_name', 'UserProfileController@updateName')->name('user.profile.edit.name');
Route::post('/edit_phone', 'UserProfileController@updatePhone')->name('user.profile.edit.phone');
Route::post('/edit_dob', 'UserProfileController@updateDOB')->name('user.profile.edit.dob');
Route::post('/edit_sex', 'UserProfileController@updateSex')->name('user.profile.edit.sex');
Route::post('/edit_address', 'UserProfileController@updateAddress')->name('user.profile.edit.address');
Route::post('/edit_bank', 'UserProfileController@updateBank')->name('user.bank.edit');



/**
 * Logout
 */
Route::get("logout", function(Request $request){
    return view(RSP::USER_LOGOUT);
})->name("user.logout.page");

Route::post("logout", function(){
    Auth::logout();
    return redirect()->route("index");
})->name("user.logout.process");
