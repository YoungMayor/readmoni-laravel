<?php

namespace App\Http\Controllers;

use App\Notifications\BankDetailsChanged;
use App\Notifications\PayoutRequested;
use Illuminate\Http\Request;

use App\Providers\RouteServiceProvider AS RSP;

use App\UserNotification;
use App\User;
use App\UserBank;


use Illuminate\Support\Facades\Auth;
use RM;


class UserNotificationController extends Controller
{
    /**
     * @todo
     * Error logging for the entire class 
     */
    public static $catICON = [
        'act' => 'fas fa-smile-beam bg-success', /**Account Activated */ 
        'txnin' => 'fas fa-piggy-bank bg-secondary', /** Transfer received */
        'txnout' => 'fas fa-piggy-bank bg-warning', /** Transfer made */
        'ref' => 'fas fa-donate bg-secondary', /** Referal bonus */
        'pytrq' => 'fas fa-download bg-info', /** Payment Request */ 
        'err' => 'fa fa-warning bg-danger', /** Custom error */
        'scc' => 'fa fa-check-square-o bg-success', /** Custom success */
        'lowbal' => 'fas fa-frown bg-danger', /** Insufficient Balance */
        'pytmd' => 'fas fa-wallet bg-success', /** Payment made */
        'bank' => 'fa fa-bank', /** Bank Details changed */
    ];
    protected static function saveNotification($id, $note, $cat){
        return UserNotification::create([
            'user_id' => $id, 
            'note' => $note, 
            'category' => $cat
        ]);
    }

    public static function accountActivated($id, $amt){
        $user = User::find($id);
        if (!$user){
            return false;
        }
        $name = $user->full_name;
        $amt = number_format($amt, 2);

        self::saveNotification($id, "Congratulations <b>$name</b>, Your Account has been successfully activated. And your funds have been credited with <b>N$amt</b>. Read and earn more!!!", 'act');

        return true;
    }

    public static function referalBonus($refererID, $refererName, $amt){
        $amt = number_format($amt, 2);

        self::saveNotification($refererID, "<b>N$amt</b> has been received as referal bonus from <b>$refererName</b>. Invite more people and earn more", 'ref');

        return true;
    }

    public static function transaction($fromID, $toID, $amt){
        $amt = number_format($amt, 2);
        $from = User::find($fromID); 
        $to = User::find($toID); 

        self::saveNotification($toID, "<b>{$from->full_name}</b> transfered <b>N$amt</b> to you. Be sure to say Thank You", 'txnin');
        self::saveNotification($fromID, "You have transfered <b>N$amt</b> to <b>{$to->full_name}</b>. Thank you for your kind gesture.", 'txnout');
        return true;
    }

    public static function paymentRequest($userID){
        $user = User::find($userID); 
        $userKey = $user->user_key;
        $userBank = UserBank::where('user_key', $userKey)->first();

        self::saveNotification($userID, "You made a payment request. Payments would be made to </b>{$userBank->account_name} ({$userBank->account_number})</b>. Keep reading to increase your payout", 'pytrq');

        $user->notify(new PayoutRequested($userBank));
        return true;
    }

    public static function BankChange($userID){
        $user = User::find($userID); 
        $userKey = $user->user_key;
        $userBank = UserBank::where('user_key', $userKey)->first();

        self::saveNotification($userID, "Your Bank Account Details were successfully changed. New Details are: <b>{$userBank->account_name} ({$userBank->account_number}) | {$userBank->bank_name}</b>", 'bank');

        $user->notify(new BankDetailsChanged($userBank));
        return true;
    }

    public static function customError($id, $note){
        self::saveNotification($id, $note, 'err');
        return true;
    }

    public static function customSuccess($id, $note){
        self::saveNotification($id, $note, 'scc');
       
       return true;
    }

    public static function insufficientFunds($id){
        $minPyt = config('app.MINIMUM_PAYOUT');

        self::saveNotification($id, "Your payment request could not be honored due to insufficient funds. You need a minimum of <b>$minPyt</b> before cashouts can be made.", 'lowbal');
    }

    public function payoutMade($payoutID){
        /**
         * @todo would be developed fully after payouts mechanism is built
         */
        // $payout =
        $id = 1;
        $note = "In response to your payment request made May 10th, 2020. You have been paid N1,260. Payments were made to Meyoron Aghogho Happiness (12345678900)";
        self::saveNotification($id, $note, 'pytmd');
    }

    public function showPage(){
        return view(RSP::USER_NOTIFICATIONS);
    }

    public static function unreadNotificationCount(){
        return UserNotification::where('user_id', Auth::id())->where('read', 'n')->count() ?? 0;
    }

    protected function loadNotifs(Request $request, $lim = 25){
        $notif = UserNotification::where('user_id', Auth::id())->latest()->simplePaginate($lim);
        
        $notifList = [];
        $count = 0; 
        foreach($notif as $thisNotif){
            $notifList[$count]['nt'] = $thisNotif->note;
            $notifList[$count]['cat'] = $thisNotif->category;
            if ($thisNotif->read == 'n'){
                $notifList[$count]['ur'] = 1;
            }
            $notifList[$count]['dt'] = RM::beautyDate($thisNotif->created_at);
            $count++;
        }
        if ($notifList){
            $response['list'] = $notifList;
            $response['next'] = $notif->currentPage() + 1;
        }else{
            $response['next'] = $notif->currentPage();
            $response['list'] = [];
        }
        return json_encode($response);
    }

    protected function readAllNotifs(){
        UserNotification::where('user_id', Auth::id())->where('read', 'n')->update([
            'read' => 'y'
        ]); 
    }

    public function recentNotifs(Request $request){
        return $this->loadNotifs($request, 3);
    }

    public function getNotifs(Request $request){
        $notifs = $this->loadNotifs($request, 25);
        $this->readAllNotifs();
        return $notifs;
    }
}
