<?php

function money($value){
    return number_format($value, 2, '.', ' ');
}

function refs($login)
{
    return \App\User::whereRefLogin($login)->count();
}

function getTheContent($type, $wallet)
{
    return \App\Models\WalletInstruction::whereType($type)->whereWallet($wallet)->first();
}

function endDate($created, $days)
{
    $end = \Carbon\Carbon::parse($created)->addDays($days);
    return $end;
}

function isActiveRefsCount()
{
    $me = \Auth::user();
    return \App\User::whereRefLogin($me->lower_login)->whereIsActive(true)->count();
}

function RefsReward($id)
{
    $me = \Auth::user();
    $reward = \App\Models\RefsReward::whereToId($me->id)
        ->whereFromId($id)
        ->get()
        ->sum('amount');

    $reward = money($reward);

    return $reward;
}

function myRefsPayments($id)
{
    $payments = \App\Models\Deposit::whereUserId($id)
        ->get()
        ->sum('payment_amount');

    $payments = money($payments);

    return $payments ?: '0.00';
}

function textTable($headers,$data,$options = []){
    $lengths = [];
    foreach($headers as $key => $value){
        $lengths[$key] = strlen($value);
    }
    foreach($data as $rows){
        foreach($rows as $key => $value){
            $lengths[$key] = max($lengths[$key],strlen($value));
        }
    }
    $table = [];

    $row = [];
    foreach($headers as $key => $value){
        $length = $lengths[$key];
        $row[] = $value.str_repeat(' ',$length-strlen($value));
    }
    $table[] = $row;

    $row = [];
    foreach($headers as $key => $value){
        $length = $lengths[$key];
        if(isset($options[$key]) && $options[$key]){
            $x = ($options[$key] == 'center') ? str_repeat('-',$length-2) : str_repeat('-',$length-1);

            if($options[$key] == 'right'){
                $x = $x.':';
            }elseif($options[$key] == 'center'){
                $x = ':'.$x.':';
            }
            $row[] = $x;
        }else{
            $row[] = str_repeat('-',$length);
        }
    }
    $table[] = $row;

    foreach($data as $rows){
        $row = [];
        foreach($rows as $key => $value){
            $length = $lengths[$key];
            $row[] = $value.str_repeat(' ',$length-strlen($value));
        }
        $table[] = $row;
    }
    $text = '';
    foreach($table as $row){
        $text .= '| '.implode(' | ',$row).' |'.PHP_EOL;
    }

    return $text;
}

function mailDailyPayment($user){
    $today = \Carbon\Carbon::now();
    $deposits = $user->userDepositStatusFalse;
    $dailyPaymentTotal = false;
    foreach ($deposits as $deposit) {
        $endDate = \Carbon\Carbon::parse($deposit->created_at)->addDays($deposit->plan->days_multiply);
        do {
            if ($today <= $endDate) {
                $depositReward = new \App\Models\DepositRewards();

                $dailyPayment = $deposit->payment_amount * $deposit->plan->percent / 100;
                $deposit->increment('accrued', $dailyPayment);

                $depositReward->user_id = $user->id;
                $depositReward->deposit_id = $deposit->id;
                $depositReward->amount = $dailyPayment;

                $depositReward->save();

                $dailyPaymentTotal += $dailyPayment;
                $user->increment('money', $dailyPayment);
            } else {
                if ($deposit->plan_id != 4) {
                    $deposit->update(['status' => 'Обработан']);
                }

                $user->increment('money', $deposit->payment_amount);
                break;
            }
        } while(true);
    }

    if(!empty($dailyPayment)){
        $dailyPayment = money($dailyPaymentTotal);
    }
    return !empty($dailyPayment) ? $dailyPayment : null;
}


function AllMyDeposits($deposit_id){
    $deposits = \App\Models\DepositRewards::whereDepositId($deposit_id)
        ->whereUserId(\Auth::user()->id)
        ->get();
    return $deposits;
}

function allRefsSum(){
    $total =\App\Models\RefsReward::whereToId(\Auth::user()->id)->get()->sum('amount');
    $total = number_format($total, 2, '.', ' ');
    return $total ? $total : "0.00";
}

function allIncomesFromDeposits(){
    $total = \App\Models\DepositRewards::whereUserId(\Auth::user()->id)
        ->get()->sum('amount');
    $total = money($total);
    return $total;
}

function allMyPayments(){
    $total = \App\Models\Payment::whereUserId(\Auth::user()->id)
        ->whereStatusId(2)->whereType('Вывод')->get()->sum('amount');
    $total = money($total);

    return $total;
}

function accruedMoney($id){
    $deposit = \App\Models\DepositRewards::whereUserId(\Auth::user()->id)
        ->whereDepositId($id)->get()->sum('amount');
    $deposit = money($deposit);

    return $deposit;
}

function businessProLeftDay($deposit){
    $now = \Carbon\Carbon::now();
    $pay_date = \Carbon\Carbon::parse($deposit->created_at)->copy()->addDays(14);
    return $pay_date->diffInDays($now);
}

function AllRegisteredRefs(){
    return \App\User::whereRefLogin(\Auth::user()->lower_login)->orderBy('created_at', 'desc')->count();
}
