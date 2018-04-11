<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdvCashController extends Controller
{
    public function pay($payment_id){
	    $view = view('advcash.pay');

    	$me = \Auth::user();

	    $payment = $me->payments()->findOrFail($payment_id);

	    $view->ac_account_email = $ac_account_email = config('services.advcash.email');
	    $view->ac_sci_name = $ac_sci_name = config('services.advcash.sci_name');
	    $secret = config('services.advcash.secret');

	    $ac_amount = $payment->amount;
	    $ac_order_id = $payment->id;

	    $ac_currency = 'USD';

	    $sign = hash('sha256',implode(':',[
		    $ac_account_email,
	        $ac_sci_name,
	        $ac_amount,
	        $ac_currency,
	        $secret,
	        $ac_order_id,
	    ]));

	    $view->amount = $ac_amount;
	    $view->currency = $ac_currency;
	    $view->order_id = $ac_order_id;
	    $view->sign = $sign;
	    $view->ac_ps = 'ADVANCED_CASH';
	    return $view;
    }
    public function status(Request $request){
		$allower_ips = ['50.7.115.5', '51.255.40.139'];
	    if(in_array($request->ip(),$allower_ips)){

	    }else{
	    	abort(404);
	    }
    }
    public function success(){

    }
    public function fail(){

    }
}
