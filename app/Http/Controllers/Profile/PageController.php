<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function deposit(){
        $view = view("profile.deposit");
        $view->me = \Auth::user();
        return $view;
    }

    public function payments(){
        $view = view("profile.payments");
        $view->me = \Auth::user();
        return $view;
    }

    public function cabinet(){
        $view = view("profile.cabinet");
        $view->me = \Auth::user();
        return $view;
    }

    public function refs(){
        $view = view("profile.refs");
        $view->me = \Auth::user();
        return $view;
    }
}
