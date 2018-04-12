<?php

namespace App\Http\Controllers\Admin;

use App\Models\Deposit;
use App\Models\Payment;
use App\Models\Plan;
use App\Models\WalletInstruction;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    //

    public function index(){
        $view = view("admin.index");
        return $view;
    }

    /*Users*/
    public function users(){
        $view = view("admin.users.index");
        $view->me = \Auth::user();
        $view->users = User::all();
        return $view;
    }

    public function editUser($id){
        $view = view("admin.users.editUser");
        $view->me = \Auth::user();
        $view->user = $user = User::findOrFail($id);
        $view->payments = $user->payments()->orderBy('id', 'desc')->paginate(10);
        return $view;
    }

    public function openDeposit($id){
        $view = view("admin.users.openDeposit");
        $view->me = \Auth::user();
        $view->deposits = Deposit::whereUserId($id)->paginate(10);
        $view->plans = Plan::all();
        $view->user_id = $id;
        return $view;
    }

    /*Users End*/

    public function payments(){
        $view = view("admin.payments");
        $view->me = \Auth::user();
        $view->payments = Payment::query()->orderBy('id', 'desc')->paginate(20);
        return $view;
    }

    public function deposits(){
        $view = view("admin.deposits");
        $view->deposits = Deposit::query()->paginate(20);
        return $view;
    }

    public function walletInstruction(){
        $view = view("admin.walletInstruction");
        $view->me = \Auth::user();
        $view->instructions = WalletInstruction::all();
        return $view;
    }
}
