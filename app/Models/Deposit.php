<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    //

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function plan (){
        return $this->belongsTo(Plan::class, 'plan_id');
    }
}
