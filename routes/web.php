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
    

Route::fallback(function(){
    return view(RSP::USER_404);
});
