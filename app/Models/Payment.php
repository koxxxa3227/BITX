<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //

    public function user (){
        return $this->belongsTo(User::class);
    }

    public function payFrom(){
        return $this->belongsTo(User::class, 'from_id');
    }
}
