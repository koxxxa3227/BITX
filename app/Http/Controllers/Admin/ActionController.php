<?php

namespace App\Http\Controllers\Admin;

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
}
