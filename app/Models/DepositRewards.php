<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DepositRewards extends Model
{
    public function getAmountAttribute($value){
        return number_format($value, 2, '.', ' ');
    }
}
