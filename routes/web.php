<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Providers\RouteServiceProvider as RSP;

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
 
Auth::routes(['verify' => true]);


Route::get("/", function(){
    if (Auth::check()){
        return redirect()->route("user.dashboard.page");
    }else{
        return redirect()->route("login");
    }
})->name("index");


Route::get("/error", function(){
    return view(RSP::USER_ERROR);
})->name("user.error.page");

Route::get("/success", function(){
    return view(RSP::USER_SUCCESS);
})->name("user.success.page");


/**
 * Open Pages
 */

    /**
     * Static Pages
     */    
    Route::get("/about", function(){
        return view(RSP::USER_ABOUT);
    })->name("user.about.page");
    
    Route::get("/faq", "QuestionController@showPage")->name("user.faq.page");

    Route::post("/get_answer", "QuestionController@getAnswer")->name("user.faq.process");

    Route::post('/ask_question', "QuestionController@askQuestion")->name("user.faq.ask");
    
    Route::get("/feedback", function(){
        return view(RSP::USER_FEEDBACK);
    })->name("user.feedback.page")->middleware(['auth']);
    
    Route::get("/privacy", function(){
        return view(RSP::USER_PRIVACY);
    })->name("user.privacy.page");
    
    Route::get("/terms", function(){
        return view(RSP::USER_TERMS);
    })->name("user.terms.page");
    
    Route::get("/testimonies", function(){
        return view(RSP::USER_TESTIMONY);
    })->name("user.testimony.page");

    
    


    /**
     * Activation 
     */
    Route::get("/activate-account@{key}", "ActivateAccountController@showActivateAccountPage")->name("user.activate.page");

    Route::post("/activate-now", "ActivateAccountController@redirectToGateWay")->name("user.activate.process");

    Route::get("/confirm-payment", "ActivateAccountController@handleGatewayCallback")->name("user.activate.confirm.process"); 
    
    Route::get("/account-activated@{key}", "ActivateAccountController@showAccountActivatedPage")->name("user.activate.success.page")->middleware(['activated']);
    


    Route::group(['middleware' => ['verified', 'activated']], function () {
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
    });    



/**
 * Logout
 */
Route::get("logout", function(){
    Auth::logout();
    return redirect()->route("index");
})->name("user.logout.page");


Route::fallback(function(){
    return view(RSP::USER_404);
});
