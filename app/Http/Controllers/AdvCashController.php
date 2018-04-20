<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class AdvCashController extends Controller {
	public function pay( $payment_id ) {
		$view = view( 'advcash.pay' );

		$me = \Auth::user();

		$payment_systems = [
			'adv' => 'ADVANCED_CASH',
			'payeer' => 'PAYEER',
			'pm' => 'PERFECT_MONEY',
			'btc' => 'BITCOIN'
			//ECOIN
			//ECOIN_VOUCHER
			//EPAY
			//EPESE
			//EXMO
			//OKPAY
			//PAXUM
			//WEX
		];

		$payment = $me->payments()
		              ->whereStatusId( 1 )
		              ->whereType( 'Пополнение' )
		              ->whereIn( 'payment_system', array_keys($payment_systems) )
		              ->findOrFail( $payment_id );

		$ac_ps = $payment_systems[$payment->payment_system];

		$view->ac_account_email = $ac_account_email = config( 'services.advcash.email' );
		$view->ac_sci_name      = $ac_sci_name = config( 'services.advcash.sci_name' );
		$secret                 = config( 'services.advcash.secret' );

		$ac_amount   = $payment->amount;
		$ac_order_id = $payment->id;

		$ac_currency = 'USD';

		$sign = hash( 'sha256', implode( ':', [
			$ac_account_email,
			$ac_sci_name,
			$ac_amount,
			$ac_currency,
			$secret,
			$ac_order_id,
		] ) );

		$view->amount   = $ac_amount;
		$view->currency = $ac_currency;
		$view->order_id = $ac_order_id;
		$view->sign     = $sign;
		$view->ac_ps    = $ac_ps;


		return $view;
	}

	public function status( Request $request ) {
		$allower_ips = [ '50.7.115.5', '51.255.40.139' ];
		\Log::info( 'adv-cache/status', [
			'ip'      => $request->ip(),
			'method'  => $request->method(),
			'request' => $request->all()
		] );
		if ( in_array( $request->ip(), $allower_ips ) ) {
			$secret = config( 'services.advcash.secret' );
			$sign   = hash( 'sha256', implode( ':', [
				$request->ac_transfer,// ID-номер операции (ac_transfer)
				$request->ac_start_date,// Дата операции (ac_start_date)
				$request->ac_sci_name,// Название SCI Продавца (ac_sci_name)
				$request->ac_src_wallet,// Кошелек Покупателя (ac_src_wallet)
				$request->ac_dest_wallet,// Кошелек Продавца (ac_dest_wallet)
				$request->ac_order_id,// ID-номер заказа (ac_order_id)
				$request->ac_amount,// Сумма платежа (ac_amount)
				$request->ac_merchant_currency,// Валюта платежа (ac_merchant_currency)
				$secret,
			] ) );

			if ( $sign === $request->ac_hash && $request->ac_transaction_status == 'COMPLETED' ) {
				$payment            = Payment::findOrFail( $request->ac_order_id );
				$payment->status_id = 2;
				$payment->save();


				$payment->user->increment( 'money', $request->ac_amount );
			}

		} else {
			abort( 404 );
		}
	}

	public function success( Request $request ) {
		\Log::info( 'advcash/success', [
			'ip'      => $request->ip(),
			'method'  => $request->method(),
			'request' => $request->all()
		] );

		return redirect()->action( 'Profile\PageController@payments' )
		                 ->with( 'message', 'Платеж успешен! Ваш баланс был пополнен' );
	}

	public function fail( Request $request ) {

		\Log::info( 'advcash/fail', [
			'ip'      => $request->ip(),
			'method'  => $request->method(),
			'request' => $request->all()
		] );

		return redirect()->action( 'Profile\PageController@payments' )
		                 ->with( 'message', 'Ошибка платежа! Если вы уверены что успешно оплатили счет свяжитесь с администрацией для решения вашего вопроса' );
	}
}
