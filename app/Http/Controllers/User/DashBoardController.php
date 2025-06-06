<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use App\Http\Controllers\BalanceController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\User\NewsController;

use App\Providers\RouteServiceProvider AS RSP;

use Illuminate\Support\Facades\Auth;

class DashBoardController extends Controller
{
    public function showPage(){
        $todayReadCount = NewsController::dailyReadCount(Auth::id());
        $totalReadCount = NewsController::totalReadCount(Auth::id());
        return view(RSP::USER_DASHBOARD, [
            'daily_earn' => number_format($todayReadCount * config('app.READ_BONUS'),2), 
            'balance' => number_format(BalanceController::userBalance(Auth::id()), 2),
            'total_earn' => number_format($totalReadCount * config('app.READ_BONUS'),2), 
            'read_percentage' => number_format((($todayReadCount / config('app.DAILY_READ_LIMIT')) * 100), 2), 
            'daily_read' => number_format($todayReadCount, 0), 
            'total_read' => number_format($totalReadCount, 0)
        ]);
    }
}
