<?php

namespace App\Notifications;

use App\User;
use App\UserBank;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class PayoutRequested extends Notification implements ShouldQueue
{
    use Queueable;

    public $bank, $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, UserBank $bank)
    {
        $this->user = $user;
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
                    ->subject(config('app.name').' - Payment Request Received')
                    ->greeting('Payout Request Successful')
                    ->line("Hello {$this->user->full_name} ({$this->user->user_key})")
                    ->line('Your request to be paid has been received and is been processed by our Administrators.')
                    ->line('Payments will be made to:')
                    ->line('Bank Name:      '.$this->bank->bank_name)
                    ->line('Account Name:   '.$this->bank->account_name)
                    ->line('Account Number: '.$this->bank->account_number)
                    ->line('Payment requests are handled in less than 7 days...')
                    // ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
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
