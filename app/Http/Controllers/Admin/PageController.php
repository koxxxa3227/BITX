<?php

namespace App\Http\Controllers\Admin;

use App\Models\Payment;
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

    public function users(){
        $view = view("admin.users.index");
        $view->me = \Auth::user();
        $view->users = User::all();
        return $view;
    }

    public function editUser($id){
        $view = view("admin.users.editUser");
        $view->me = \Auth::user();
        $view->user = User::findOrFail($id);
        return $view;
    }

    public function payments(){
        $view = view("admin.payments");
        $view->me = \Auth::user();
        $view->payments = Payment::query()->paginate(20);
        return $view;
    }
}
