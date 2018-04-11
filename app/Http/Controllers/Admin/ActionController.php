<?php

namespace App\Http\Controllers\Admin;

use App\Models\Deposit;
use App\Models\Payment;
use App\Models\WalletInstruction;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActionController extends Controller
{
    public function editUserSaver(Request $request, $id){
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

    public function addBonus(Request $request, $id){
        if($request->bonus_amount){
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


    public function updatePaymentStatus(Request $request, $id){
        $payment = Payment::findOrFail($id);

        $payment->status_id = $request->status_id;
        $payment->save();

        if($request->status_id == 2){
            $ref = $payment->user->ref_login;
            if($ref){
                $reffer = User::whereLogin($ref)->first();
                $reffer->increment('money', $payment->amount * .11);
            }
            $payment->user->increment('money', $payment->amount);
        }

        \Session::flash('status', 'Сохранено');
        return back();
    }

    public function updateDepositStatus(Request $request, $id){
        $deposit = Deposit::findOrFail($id);

        $deposit->status = $request->status;
        $deposit->save();



        if($request->status == "Завершен"){
            $deposit->user->increment('money', $deposit->income_with_percent);
        }

        \Session::flash('status', 'Сохранено');
        return back();
    }

    public function walletInstructionSaver(Request $request){
        WalletInstruction::whereWallet('payeer')->update(['content' => $request->payeer]);
        WalletInstruction::whereWallet('pm')->update(['content' => $request->pm]);
        WalletInstruction::whereWallet('adv')->update(['content' => $request->adv]);
        WalletInstruction::whereWallet('btc')->update(['content' => $request->btc]);
        WalletInstruction::whereWallet('eth')->update(['content' => $request->eth]);

        \Session::flash("status", 'Сохранено');
        return back();
    }
}
