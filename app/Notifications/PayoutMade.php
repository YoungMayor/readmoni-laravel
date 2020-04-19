<?php

namespace App\Notifications;

use App\Payout;
use App\User;
use App\UserBank;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PayoutMade extends Notification implements ShouldQueue
{
    use Queueable;

    protected $user, $payout, $bank;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, Payout $payout, UserBank $bank)
    {
        $this->user = $user;
        $this->payout = $payout;
        $this->bank = $bank;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject(config('app.name').' - Payout Successful')
                    ->greeting('Congratulations '.$this->user->fill_name)
                    ->line("In response to your payoy request made {$this->payout->created_at}. You have just been paid &#x20A6;{$this->payout->paid_amt}.")
                    ->line('Payments were made to the bank details configured on your '.config('app.name').' account:')
                    ->line('Bank Name:      '.$this->bank->bank_name)
                    ->line('Account Name:   '.$this->bank->account_name)
                    ->line('Account Number: '.$this->bank->account_number)
                    // ->action('Notification Action', url('/'))
                    ->line('Spread the word!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
