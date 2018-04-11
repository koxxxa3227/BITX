<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DepositAccrued extends Model
{
    //

    public function deposit (){
        return $this->belongsTo(Deposit::class, 'deposit_id');
    }
}
