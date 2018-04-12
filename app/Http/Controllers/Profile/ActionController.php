<?php

namespace App\Http\Controllers\Profile;

use App\Models\Deposit;
use App\Models\DepositAccrued;
use App\Models\Payment;
use App\Models\Plan;
use App\Models\RefsReward;
use App\Models\Wallet;
use App\Notifications\DepositCreatorNotification;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActionController extends Controller
{
    public function personalDataSaver(Request $request)
    {
        $me = \Auth::user();

        if (\Hash::check($request->old_password, $me->password)) {

            if (!empty($request->email)) $me->email = $request->email;
            if (!empty($request->login)) {
                $me->login = $request->login;
                $me->lower_login = strtolower($request->login);
            }
            if (!empty($request->new_password)) {
                if ($request->new_password == $request->password_confirmation) {
                    $me->password = \Hash::make($request->new_password);
                } else {
                    \Session::flash('status', 'Не правильно введен новый пароль');
                    return back();
                }
            }

            $me->save();
            \Session::flash('status', 'Сохранено успешно');
        } else {
            \Session::flash('status', 'Неверно введен пароль');
        }

        return back();
    }

    public function personalWalletsSaver(Request $request)
    {
        $me = \Auth::user();
        $wallet = $me->myWallets;
        if (!$wallet) {
            $wallet = new Wallet();
            $wallet->user_id = $me->id;
        }

        if (!empty($request->payeer_wallet)) $wallet->payeer = $request->payeer_wallet;
        if (!empty($request->pm_wallet)) $wallet->pm = $request->pm_wallet;
        if (!empty($request->ltc_wallet)) $wallet->ltc = $request->ltc_wallet;
        if (!empty($request->eth_wallet)) $wallet->eth = $request->eth_wallet;
        if (!empty($request->btc_wallet)) $wallet->btc = $request->btc_wallet;
        if (!empty($request->adv_wallet)) $wallet->adv = $request->adv_wallet;

        $wallet->save();

        \Session::flash('status', 'Сохранено успешно');
        return back();
    }

    public function paymentsRequest(Request $request)
    {
        $me = \Auth::user();

        if ($me->money >= $request->withdraw_amount) {

            $payments = new Payment();

            $payments->user_id = $me->id;
            $payments->type = "Вывод";
            $payments->payment_system = $payment_system = isset($request->payment_system) ? $request->payment_system : $request->payment_system_mobile;
            $payments->amount = $request->withdraw_amount;

            $payments->save();

            \Session::flash('status', 'Запрос принят.');
        } else {
            \Session::flash('status', 'Недостаточно денег');
        }

        return redirect()->action('Profile\PageController@payments', $payment_system);
    }

    public function depositsRequest(Request $request)
    {
        $me = \Auth::user();

        if ($me->money >= $request->payment_amount) {
            $me->is_active = true;
            $me->save();
            $deposit = new Deposit();
            $plan = Plan::findOrFail($request->hidden_plan_id);

            $deposit->user_id = $me->id;
            $deposit->plan_id = $request->hidden_plan_id;
            $deposit->payment_amount = $request->payment_amount;
            $result = $request->payment_amount * $plan->percent / 100 * $plan->days_multiply;
            $deposit->income_with_percent = number_format($result, 2, '.', ' ');

                $deposit->save();

            $reffer = $me->reffer;
            if($reffer) {
                $payment = new Payment();

                $payment->user_id = $reffer->id;
                $payment->type = "Реферальное вознаграждение";
                $payment->amount = $request->payment_amount * .11;
                $payment->status_id = 2;

                $refRewards = new RefsReward();

                $refRewards->from_id = $me->id;
                $refRewards->to_id = $reffer->id;
                $refRewards->amount = $request->payment_amount * .11;

                $payment->save();
                $refRewards->save();
                $me->reffer->increment('money', $request->payment_amount * .11);
            }

            $depositAccrued = new DepositAccrued();

            $depositAccrued->user_id = $me->id;
            $depositAccrued->deposit_id = $deposit->id;
            $depositAccrued->last_accrued = Carbon::now();
            $depositAccrued->end_date = Carbon::now()->addDays($deposit->plan->days_multiply);

            $depositAccrued->save();

            $me->increment('money', -$request->payment_amount);

            $me->notify(new DepositCreatorNotification($deposit));

            \Session::flash('status', 'Депозит создан');
        } else {
            \Session::flash('status', 'Недостаточно денег');
        }

        return back();
    }

    public function replenishmentRequest(Request $request)
    {
        $me = \Auth::user();

        $payments = new Payment();

        $payments->user_id = $me->id;
        $payments->type = "Пополнение";
        $payments->payment_system = $payment_system = isset($request->payment_system) ? $request->payment_system : $request->payment_system_mobile;
        $payments->amount = $request->replenishment_amount;

        $payments->save();

        $view = view('profile.payments');
        $view->me = $me;
        $view->payments = $me->payments()->orderBy('id', 'desc')->paginate(10);
        $view->popup = $payment_system;

        return redirect()->action('Profile\PageController@payments', $payment_system);
    }
}
