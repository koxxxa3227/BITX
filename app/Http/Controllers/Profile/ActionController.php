<?php

namespace App\Http\Controllers\Profile;

use App\Models\Deposit;
use App\Models\Payment;
use App\Models\Plan;
use App\Models\Wallet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActionController extends Controller
{
    public function personalDataSaver(Request $request){
        $me = \Auth::user();

        if(\Hash::check($request->old_password, $me->password)){

            if(!empty($request->email)) $me->email = $request->email;
            if(!empty($request->login)){ $me->login = $request->login; $me->lower_login = strtolower($request->login);}
            if(!empty($request->new_password)){
                if($request->new_password == $request->password_confirmation) {
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

    public function personalWalletsSaver(Request $request){
        $me = \Auth::user();
        $wallet = $me->myWallets;
        if(!$wallet) {
            $wallet = new Wallet();
            $wallet->user_id = $me->id;
        }

        if(!empty($request->payeer_wallet)) $wallet->payeer = $request->payeer_wallet;
        if(!empty($request->pm_wallet)) $wallet->pm = $request->pm_wallet;
        if(!empty($request->ltc_wallet)) $wallet->ltc = $request->ltc_wallet;
        if(!empty($request->eth_wallet)) $wallet->eth = $request->eth_wallet;
        if(!empty($request->btc_wallet)) $wallet->btc = $request->btc_wallet;
        if(!empty($request->adv_wallet)) $wallet->adv = $request->adv_wallet;

        $wallet->save();

        \Session::flash('status', 'Сохранено успешно');
        return back();
    }

    public function paymentsRequest(Request $request){
        $me = \Auth::user();

        if($me->money >= $$request->withdraw_amount) {

            $payments = new Payment();

            $payments->user_id = $me->id;
            $payments->payment_system = isset($request->payment_system) ? $request->payment_system : $request->payment_system_mobile;
            $payments->amount = $request->withdraw_amount;

            $payments->save();

            \Session::flash('status', 'Запрос принят.');
        } else {
            \Session::flash('status', 'Недостаточно денег');
        }

        return back();
    }

    public function depositsRequest(Request $request){
        $me = \Auth::user();
        if($me->money >= $request->enter_amount) {
            $deposit = new Deposit();
            $plan = Plan::findOrFail($request->hidden_plan_id);

            $deposit->user_id = $me->id;
            $deposit->plan_id = $request->hidden_plan_id;
            $deposit->payment_amount = $request->enter_amount;
            $deposit->income_with_percent = $request->enter_amount * $plan->percent;
            $deposit->payment_system = $request->payment_system;

            $deposit->save();

            $me->increment('money', -$request->enter_amount);

            \Session::flash('status', 'Депозит создан');
        } else {
            \Session::flash('status', 'Недостаточно денег');
        }

        return back();
    }
}
