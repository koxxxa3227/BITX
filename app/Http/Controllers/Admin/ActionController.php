<?php

namespace App\Http\Controllers\Admin;

use App\Models\Deposit;
use App\Models\DepositAccrued;
use App\Models\DepositRewards;
use App\Models\Payment;
use App\Models\Plan;
use App\Models\RefsReward;
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

        User::whereRefLogin($user->lower_login)->update(['ref_login' => strtolower($request->login)]);
        $user->login = $request->login;
        $user->lower_login = strtolower($request->login);
        $user->email = $request->email;
        $user->role = $request->role;
        $user->money = $request->money;
        $user->skype = $request->skype;
        $user->telegram = $request->telegram;

        if ($request->register_date && $request->register_time) {
            $date = Carbon::parse($request->register_date);
            $time = Carbon::parse($request->register_time);
            $new_date = Carbon::create($date->year, $date->month, $date->day, $time->hour, $time->minute, '00');

            $user->created_at = $new_date;
        }

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
//            $ref = $payment->user->ref_login;
//            if ($ref) {
//                User::whereLowerLogin($ref)->first()->increment('money', $payment->amount * .11);
////                $reffer->increment('money', $payment->amount * .11);
//            }

            if ($request->type == 1) {
                $payment->user->increment('money', $payment->amount);
            } else {
                if ($payment->user->money >= $payment->amount) {
                    $payment->user->increment('money', -$payment->amount);
                } else {
                    $payment->user->money = 0;
                    $payment->user->save();
                }
            }
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
        if ($request->type == 1) {
            WalletInstruction::whereType(1)->whereWallet('payeer')->update(['content' => $request->payeer]);
            WalletInstruction::whereType(1)->whereWallet('pm')->update(['content' => $request->pm]);
            WalletInstruction::whereType(1)->whereWallet('adv')->update(['content' => $request->adv]);
            WalletInstruction::whereType(1)->whereWallet('btc')->update(['content' => $request->btc]);
            WalletInstruction::whereType(1)->whereWallet('eth')->update(['content' => $request->eth]);
        } else {
            WalletInstruction::whereType(2)->whereWallet('payeer')->update(['content' => $request->payeer]);
            WalletInstruction::whereType(2)->whereWallet('pm')->update(['content' => $request->pm]);
            WalletInstruction::whereType(2)->whereWallet('adv')->update(['content' => $request->adv]);
            WalletInstruction::whereType(2)->whereWallet('btc')->update(['content' => $request->btc]);
            WalletInstruction::whereType(2)->whereWallet('eth')->update(['content' => $request->eth]);
        }

        \Session::flash("status", 'Сохранено');
        return back();
    }

    public function createNewDeposit(Request $request, $id)
    {
        $plan = Plan::findOrFail($request->selected_plan);
        $user = User::findOrFail($id);
        if ($user->money >= $request->payment_amount) {
            $user->increment('money', -$request->payment_amount);
            $user->is_active = 1;
            $user->save();
        } else {
            \Session::flash('status', 'У пользователя на счету не достаточно денег. Пополните для начала баланс');
            return back();
        }
        $open_date = Carbon::parse($request->open_date);
        $open_time = Carbon::parse($request->open_time);
        $open_date = Carbon::create($open_date->year, $open_date->month, $open_date->day, $open_time->hour, $open_time->minute, $open_time->second);

        $deposit = new Deposit();
        $deposit->user_id = $id;
        $deposit->plan_id = $request->selected_plan;
        $deposit->payment_amount = $request->payment_amount;
        $deposit->income_with_percent = $request->payment_amount * $plan->percent / 100 * $plan->days_multiply;
        $deposit->created_at = $open_date->copy();
        $deposit->save();

        $reffer = $user->reffer;
        if ($reffer) {
            $user->reffer->increment('money', $request->payment_amount * .11);
            $ref_rewards = new RefsReward();
            $ref_rewards->from_id = $user->id;
            $ref_rewards->to_id = $user->reffer->id;
            $ref_rewards->deposit_id = $deposit->id;
            $ref_rewards->amount = $request->payment_amount * .11;
            $ref_rewards->created_at = $open_date->copy();

            $payment = new Payment();

            $payment->from_id = $user->id;
            $payment->user_id = $user->reffer->id;
            $payment->deposit_id = $deposit->id;
            $payment->type = "Реферальное вознаграждение";
            $payment->status_id = 2;
            $payment->amount = $request->payment_amount * .11;
            $payment->created_at = $open_date->copy();


            $ref_rewards->payment_id = $payment->id;
            $ref_rewards->save();
            $payment->save();
        }

        $end_date = $open_date->copy()->addDays($plan->days_multiply);
        $open_date->addDay();
        do {
            if ($end_date >= $open_date) {
                if ($open_date > Carbon::now()) {
                    break;
                }
                $accrued_amount = $request->payment_amount * $plan->percent / 100;
                $deposit->increment('accrued', $accrued_amount);
                $deposit_reward = new DepositRewards();

                $deposit_reward->user_id = $id;
                $deposit_reward->deposit_id = $deposit->id;
                $deposit_reward->amount = $accrued_amount;
                $deposit_reward->created_at = $open_date->copy();

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
                $deposit_accrued->end_date = $end_date;
                $deposit_accrued->created_at = $open_date->copy();
                $deposit_accrued->save();

                $user->increment('money', $accrued_amount);

                $open_date->addDay();
            } else {
                if ($plan->id == 4) {
                    $deposit_accrued = DepositAccrued::whereUserId($id)
                        ->whereDepositId($deposit->id)->first();
                    $deposit_accrued->end_date = Carbon::parse($deposit_accrued->last_date)->addDays(14);
                    $deposit->status = "В обработке";
                    $deposit->save();
                } else {
                    $deposit->status = "Обработан";
                    $deposit->save();
                    $user->increment('money', $deposit->payment_amount);
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
        if ($user->money - $price >= 0) {
            $user->increment('money', -$price);
        } else {
            $user->money = 0;
            $user->save();
        }

        $payment = RefsReward::whereFromId($user_id)->whereDepositId($id)->first();

        if ($user->reffer) {
            $user->reffer->increment('money', -$payment->amount);
        }

        if ($payment) {
            $payment->delete();
        }


        DepositAccrued::whereDepositId($id)->delete();
        DepositRewards::whereDepositId($id)->delete();
        RefsReward::whereFromId($user_id)->whereDepositId($id)->delete();
        Payment::whereFromId($user_id)->whereDepositId($id)->whereType("Реферальное вознаграждение")->delete();
        Deposit::whereId($id)->delete();

        \Session::flash('status', 'Удалено!');
        return back();
    }

    public function retrofitting(Request $request, $id)
    {
        $payment_date = Carbon::parse($request->payment_date);
        $payment_time = Carbon::parse($request->payment_time);
        $user = User::findOrFail($id);
        $payment = new Payment();

        $type = $request->type;

        $payment->user_id = $id;
        $payment->payment_system = $request->payment_system;
        $payment->type = $type == 1 ? "Пополнение" : "Вывод";
        $payment->status_id = 2;
        $amount = $request->amount;
        $payment->amount = $amount;

        $created_at = Carbon::create($payment_date->year, $payment_date->month, $payment_date->day, $payment_time->hour, $payment_time->minute, $payment_time->second);
        $payment->created_at = $created_at;
        $payment->updated_at = $created_at;

        if ($type == 2) {
            if ($user->money >= $amount) {
                $user->increment('money', -$amount);
                \Session::flash('status', 'Успешно сохранено');
            } else {
                \Session::flash('status', 'Не хватает денег на счету');
                return back();
            }
        } else {
            $user->increment('money', $amount);
            \Session::flash('status', 'Успешно сохранено');
        }

        $payment->save();

        return back();
    }

    public function removePayment($id)
    {
        Payment::whereId($id)->first()->delete();

        \Session::flash('status', 'Удалено');
        return back();
    }

    public function removeRef($user_id, $id)
    {
        $reward = RefsReward::whereId($id)->first();
        $user = User::whereId($user_id);
        $payment = Payment::whereId($reward->payment_id)->first();

        $user->first()->increment('money', -$reward->amount);

        if ($user->money < 0) {
            $user->money = 0;
            $user->save();
        }

        $reward->delete();

        if ($payment) {
            $payment->delete();
        }

        \Session::flash('status', "Удалено");
        return back();
    }

    public function truncateRefs($user_id)
    {
        RefsReward::whereToId($user_id)->delete();
        Payment::whereUserId($user_id)->whereType('Реферальное вознаграждение')->delete();

        \Session::flash('status', 'Очищено');
        return back();
    }
}
