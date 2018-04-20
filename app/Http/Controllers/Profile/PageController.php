<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\DepositRewards;
use App\Models\Plan;
use App\User;

class PageController extends Controller
{
    public function deposit($plan_id = ''){
        $view = view("profile.deposit");
        $view->me = $me = \Auth::user();
        $view->plans = Plan::all();
        $view->myDeposits = $me->myDeposits()->orderBy('created_at', 'desc')->paginate(10);
        return $view;
    }

    public function payments($type = 1, $popup = ''){
        $view = view("profile.payments");
        $view->me = $me = \Auth::user();
        $view->payments = $me->payments()->orderBy('created_at', 'desc')->paginate(10);
        $view->type = $type;
        $view->popup = $popup;
        return $view;
    }

    public function cabinet(){
        $view = view("profile.cabinet");
        $view->me = $me = \Auth::user();
        $refs = User::whereRefLogin($me->lower_login);
        $view->myWallets = $me->myWallets;
        $view->depositRewards = $me->depositReward;
        return $view;
    }

    public function refs(){
        $view = view("profile.refs");
        $view->me = $me = \Auth::user();
        $refs = User::whereRefLogin($me->lower_login)->orderBy('created_at', 'desc');
        $view->myRefs = $refs->paginate(5);
        return $view;
    }
}
