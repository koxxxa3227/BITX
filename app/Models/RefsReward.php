<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class RefsReward extends Model
{
    //

    public function from_user(){
        return $this->belongsTo(User::class, 'from_id');
    }

    public function deposit(){
        return $this->belongsTo(Deposit::class, 'deposit_id');
    }
}
