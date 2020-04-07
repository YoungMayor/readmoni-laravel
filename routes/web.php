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


Route::get("/error", function(Request $request){
    return view(RSP::USER_ERROR);
})->name("user.error.page");

Route::get("/success", function(Request $request){
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
    
    Route::get("/faq", function(){
        return view(RSP::USER_FAQ);
    })->name("user.faq.page");
    
    Route::get("/feedback", function(){
        return view(RSP::USER_FEEDBACK);
    })->name("user.feedback.page");
    
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
     * Auth Pages
     */    
    
    Route::get("/recover-password", function(){
        return view(RSP::USER_PASSRECOVERY);
    })->name("user.password.recovery.page");
    
    
    Route::get("/activate-account@{key}", "ActivateAccountController@showActivateAccountPage")->name("user.activate.page");

    Route::post("/activate-now", "ActivateAccountController@redirectToGateWay")->name("user.activate.process");

    Route::get("/confirm-payment", "ActivateAccountController@handleGatewayCallback")->name("user.activate.confirm.process"); 
    
    Route::get("/account-activated@{key}", "ActivateAccountController@showAccountActivatedPage")->name("user.activate.success.page");
    


    /**
     * Profile Pages
     */    
    Route::get("/profile", function(){
        return view(RSP::USER_PROFILE);
    })->name("user.profile.page");
    
    Route::get("/edit-profile", function(){
        return view(RSP::USER_PROFILE_EDIT);
    })->name("user.profile.edit.page");


    
    /**
     * User Activities
     */
    Route::get("/dashboard", function(){
        return view(RSP::USER_DASHBOARD);
    })->name("user.dashboard.page");

    Route::get("/news", function(){
        return view(RSP::USER_NEWS);
    })->name("user.news.page");



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
