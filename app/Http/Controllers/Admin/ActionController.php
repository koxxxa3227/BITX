<?php

namespace App\Http\Controllers\Admin;

use App\Models\Deposit;
use App\Models\DepositAccrued;
use App\Models\DepositRewards;
use App\Models\Payment;
use App\Models\Plan;
use App\Models\WalletInstruction;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActionController extends Controller
{
    public function editUserSaver(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->login = $request->login;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->money = $request->money;
        $user->skype = $request->skype;
        $user->telegram = $request->telegram;

        $user->save();

        \Session::flash('status', 'Сохранено');
        return redirect()->action('Admin\PageController@users');
    }

    public function addBonus(Request $request, $id)
    {
        if ($request->bonus_amount) {
            $user = User::findOrFail($id);

            $payment = new Payment();

            $payment->user_id = $id;
            $payment->type = 'Бонус';
            $payment->amount = $request->bonus_amount;
            $payment->status_id = 2;

            $payment->save();

            $result = true;
            \Session::flash('success', 'Бонус успешно добавлен');
        } else {
            $result = false;
            \Session::flash('success', 'Сначало заполните поле необходимой суммой');
        }

        return [
            'result' => $result
        ];
    }


    public function updatePaymentStatus(Request $request, $id)
    {
        $payment = Payment::findOrFail($id);

        $payment->status_id = $request->status_id;
        $payment->save();

        if ($request->status_id == 2) {
            $ref = $payment->user->ref_login;
            if ($ref) {
                $reffer = User::whereLogin($ref)->first();
                $reffer->increment('money', $payment->amount * .11);
            }
            $payment->user->increment('money', $payment->amount);
        }

        \Session::flash('status', 'Сохранено');
        return back();
    }

    public function updateDepositStatus(Request $request, $id)
    {
        $deposit = Deposit::findOrFail($id);

        $deposit->status = $request->status;
        $deposit->save();

        if ($request->status == "Обработан") {
            $deposit->user->increment('money', $deposit->income_with_percent);
        }

        \Session::flash('status', 'Сохранено');
        return back();
    }

    public function walletInstructionSaver(Request $request)
    {
        WalletInstruction::whereWallet('payeer')->update(['content' => $request->payeer]);
        WalletInstruction::whereWallet('pm')->update(['content' => $request->pm]);
        WalletInstruction::whereWallet('adv')->update(['content' => $request->adv]);
        WalletInstruction::whereWallet('btc')->update(['content' => $request->btc]);
        WalletInstruction::whereWallet('eth')->update(['content' => $request->eth]);

        \Session::flash("status", 'Сохранено');
        return back();
    }

    public function createNewDeposit(Request $request, $id)
    {
        $plan = Plan::findOrFail($request->selected_plan);
        $user = User::findOrFail($id);
        $now = Carbon::now();
        if ($request->open_date) {
            $open_date = Carbon::parse($request->open_date)->addDay();
        } else {
            \Session::flash('status', 'Сначало нужно выбрать дату открытия');
            return back();
        }

        if ($request->open_time) {
            $open_time = Carbon::parse($request->open_time);
        } else {
            \Session::flash('status', 'Сначало нужно выбрать время открытия');
            return back();
        }
        $open_date = Carbon::create($open_date->year, $open_date->month, $open_date->day, $open_time->hour, $open_time->minute, $open_time->second);

        $deposit = new Deposit();
        $deposit->user_id = $id;
        $deposit->plan_id = $request->selected_plan;
        $deposit->payment_amount = $request->payment_amount;
        $deposit->income_with_percent = $request->payment_amount * $plan->percent / 100 * $plan->days_multiply;
        $deposit->created_at = $open_date->copy()->subDay();
        $deposit->status = "Обработан";
        $deposit->save();

        do {
            if ($now >= $open_date) {
                $accrued_amount = $request->payment_amount * $plan->percent / 100;
                $deposit->increment('accrued', $accrued_amount);
                $deposit_reward = new DepositRewards();

                $deposit_reward->user_id = $id;
                $deposit_reward->deposit_id = $deposit->id;
                $deposit_reward->amount = $accrued_amount;
                $deposit_reward->created_at = $open_date->copy()->subDay();

                $deposit_reward->save();

                $deposit_accrued = DepositAccrued::whereDepositId($deposit->id)
                    ->whereUserId($id)
                    ->first();
                if (!$deposit_accrued) {
                    $deposit_accrued = new DepositAccrued();
                    $deposit_accrued->user_id = $id;
                    $deposit_accrued->deposit_id = $deposit->id;
                }
                $deposit_accrued->last_accrued = $open_date;
                $deposit_accrued->end_date = $open_date->copy()->addDays($plan->days_multiply);
                $deposit_accrued->created_at = $open_date->copy()->subDay();
                $deposit_accrued->save();

                $user->increment('money', $accrued_amount);

                $open_date->addDay();
            } else {
                if ($plan->id == 4) {
                    $deposit_accrued = DepositAccrued::whrerUserId($id)
                        ->whereDepositId($deposit->id)->first();
                    $deposit_accrued->end_date = Carbon::parse($deposit_accrued->last_date)->addDays(14);
                }
                break;
            }
        } while (true);

        \Session::flash('status', 'Депозит создан');
        return back();
    }

    public function removeDeposit($user_id, $id)
    {
        $deposit = Deposit::findOrFail($id);
        $count = DepositRewards::whereDepositId($id)->get()->count();
        $price = $deposit->plan->percent * $deposit->payment_amount / 100;
        $price *= $count;
        $user = User::findOrFail($user_id);
        if($user->money - $price != 0) {
            $user->increment('money', -$price);
        } else {
            $user->money = 0;
            $user->save();
        }


        DepositAccrued::whereDepositId($id)->delete();
        DepositRewards::whereDepositId($id)->delete();
        Deposit::whereId($id)->delete();

        \Session::flash('staatus', 'Удалено!');
        return back();
    }
}
