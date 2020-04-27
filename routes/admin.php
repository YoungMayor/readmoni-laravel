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

Route::get('/payouts', "PayoutController@show")->name('admin.payouts.page');
Route::post('/payouts/list', "PayoutController@retrieve")->name('admin.payouts.list.process');

Route::get('/payout/pay/{user_key}', "PayoutController@retrieve")->name('admin.payouts.pay.process');
Route::post('/payout/pay/mass', "PayoutController@massPayout")->name('admin.mass.payouts.process');
Route::get('/payout/cancel/{user_key}', "PayoutController@cancelPayout")->name('admin.payouts.cancel.process');

Route::get('/audit/{user_key}', "UserAuditController@show")->name('admin.audit.page');
Route::post('/audit/notify_user', 'UserAuditController@sendMessage')->name('admin.audit.message.user');

Route::post('/audit/history/payments', 'UserAuditController@getHistory')->name('admin.audit.history.payments');

Route::get('/faq', "QuestionController@showPage")->name('admin.faq.page');
Route::get('/faq/questions', "QuestionController@getQuestions")->name('admin.faq.get.process');
Route::post('/faq/save', "QuestionController@saveQuestion")->name('admin.faq.save.process');
Route::post('/faq/delete', "QuestionController@deleteQuestion")->name('admin.faq.save.process');
