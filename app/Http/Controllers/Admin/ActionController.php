<?php

namespace App\Http\Controllers\Admin;

use App\Models\Payment;
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


    public function updatePaymentStatus(Request $request, $id){
        $payment = Payment::findOrFail($id);

        $payment->status = $request->status;
        $payment->save();

        if($request->status == "Оплачено"){
            $payment->user->increment('money', $payment->amount);
        }

        \Session::flash('status', 'Сохранено');
        return back();
    }
}
