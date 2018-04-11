<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class RefNotification extends Notification
{
    use Queueable;

    protected $payments = false;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($payments)
    {
        $this->payments = $payments;
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
        $day = Carbon::yesterday()->format('d.m.Y');
        $users = [];
        $report = [];
        foreach ($this->payments as $payment){
            if(!isset($users[$payment->from_id])){
                $users[$payment->from_id] = $payment->payFrom->login;
                $report[$payment->from_id] = 0;
            }

            $report[$payment->from_id] += $payment->amount;
        }
        $headers = [
            'Логин пользователя',
            'Принесли за сутки'
        ];
        $data = [];
        foreach ($report as $user_id => $amount){
            $data[] = [$users[$user_id], number_format($amount, 2, '.', ' ')];
        }
        $options = [
            false,
            'right'
        ];
        $table = textTable($headers,$data,$options);
        return (new MailMessage)
            ->markdown('mail.refNotification', ['day' => $day, 'table' => $table, 'total' => array_sum($report)]);
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
