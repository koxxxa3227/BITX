<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class DepositCreatorNotification extends Notification
{
    use Queueable;

    protected $deposit;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($deposit)
    {
        $this->deposit = $deposit;
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
        $amount = $this->deposit->payment_amount;
        $daily_income = $this->deposit->income_with_percent / $this->deposit->plan->days_multiply;
        $daily_income = number_format($daily_income, 2, '.', ' ');
        $total = $this->deposit->payment_amount + $this->deposit->income_with_percent;
        return (new MailMessage)
            ->greeting("Доброго времени суток")
            ->line("Открытие депозита ".strtoupper($this->deposit->plan->title)." на сумму ".$this->deposit->payment_amount."$ прошло успешно.")
            ->line("Ежедневно вы будете получать прибыль $daily_income$ и по истечению строка депозита Ваш балланс будет начислено сумма $total$");
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
