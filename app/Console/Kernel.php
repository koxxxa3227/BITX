<?php

namespace App\Console;

use App\Models\Payment;
use App\Notifications\DepositDailyPaymentNotification;
use App\Notifications\RefNotification;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $users = User::with('userDepositStatusFalse')->get();
            foreach ($users as $user){
                $dailyPayment = mailDailyPayment($user);
                if($dailyPayment){
                    $user->notify(new DepositDailyPaymentNotification($dailyPayment));
                }
            }
        })->dailyAt('00:01');

        $schedule->call(function () {
            $users = User::with('refPaymentsLastDay.payFrom')->get();
            foreach ($users as $user){
                $user->notify(new RefNotification($user->refPaymentsLastDay));
            }
        })->dailyAt('09:00');

//        $schedule->call(function () {
//            $users = User::whereId(1)->with('refPaymentsLastDay.payFrom')->get();
//            foreach ($users as $user){
//                $user->notify(new RefNotification($user->refPaymentsLastDay));
//            }
//        });

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
