<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\User;

class PageController extends Controller
{
    public function deposit(){
        $view = view("profile.deposit");
        $view->me = $me = \Auth::user();
        $refs = User::whereRefLogin($me->lower_login);
        return $view;
    }

    public function payments(){
        $view = view("profile.payments");
        $view->me = $me = \Auth::user();
        $refs = User::whereRefLogin($me->lower_login);
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
