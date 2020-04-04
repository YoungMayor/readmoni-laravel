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
 

Route::get("/", function(){
    if (Auth::check()){
        return redirect()->route("user.dashboard.page");
    }else{
        return redirect()->route("user.login.page");
    }
})->name("index");


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
    
    Route::get("/testimonies", function(){
        return view(RSP::USER_TESTIMONY);
    })->name("user.testimony.page");



    /**
     * Auth Pages
     */    
    Route::get("/login", function(){
        return view(RSP::USER_LOGIN);
    })->name("user.login.page");
    
    Route::get("/recover-password", function(){
        return view(RSP::USER_PASSRECOVERY);
    })->name("user.password.recovery.page");
    
    Route::get("/register-step1", function(){
        return view(RSP::USER_REG_FIRST);
    })->name("user.register-first.page");
    
    Route::get("/register-step2", function(){
        return view(RSP::USER_REG_FINAL);
    })->name("user.register-final.page");



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
