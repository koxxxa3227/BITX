<?php

namespace App\Http\Controllers;

use App\Notifications\Feedback;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function feedback(Request $request){
        \Notification::route('mail', 'blackrock.rf@gmail.com')->notify(new Feedback($request->name, $request->email, $request->subject, $request->message));
        return back();
    }
}
