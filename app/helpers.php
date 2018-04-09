<?php

function refs($login)
{
    return \App\User::whereRefLogin($login)->count();
}

function getTheContent($wallet){
    return \App\Models\WalletInstruction::whereWallet($wallet)->first();
}

function endDate($created, $days){
    $end = \Carbon\Carbon::parse($created)->addDays($days);
    return \Carbon\Carbon::parse($end)->format('d.M.Y H:i');
}
