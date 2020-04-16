<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Providers\RouteServiceProvider as RSP;
use Illuminate\Support\Facades\Request;

/*
|--------------------------------------------------------------------------
| Admin Account Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function(){
    return view(RSP::ADMIN_SUMMARY);
})->name('admin.site.summary.page');

Route::get('/payouts', function(){
    return view(RSP::ADMIN_PAYOUT);
})->name('admin.payouts.page');

Route::get('/audit/{user}', function(){
    return view(RSP::ADMIN_AUDIT);
})->name('admin.audit.page');

Route::get('/faq', function(){ 
    return view(RSP::ADMIN_FAQ);
})->name('admin.faq.page');
