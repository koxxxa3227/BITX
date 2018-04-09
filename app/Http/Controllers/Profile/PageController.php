<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\User;

class PageController extends Controller
{
    public function deposit(){
        $view = view("profile.deposit");
        $view->me = $me = \Auth::user();
        $view->plans = Plan::all();
        $view->myDeposits = $me->myDeposits()->orderBy('id', 'desc')->paginate(10);
        return $view;
    }

    public function payments($popup = ''){
        $view = view("profile.payments");
        $view->me = $me = \Auth::user();
        $view->myPayments = $me->myPayments()->whereType('Пополнение')->orderBy('id', 'desc')->paginate(10);
        $view->myWithdraws = $me->myPayments()->whereType('Вывод')->orderBy('id', 'desc')->paginate(10);
        $view->popup = $popup;
        return $view;
    }

    public function cabinet(){
        $view = view("profile.cabinet");
        $view->me = $me = \Auth::user();
        $refs = User::whereRefLogin($me->lower_login);
        $view->myWallets = $me->myWallets;
        return $view;
    }

    public function refs(){
        $view = view("profile.refs");
        $view->me = $me = \Auth::user();
        $refs = User::whereRefLogin($me->lower_login);
        $view->myRefs = $refs->get();
        $view->myRefsCount = $refs->count();
        return $view;
    }
}
