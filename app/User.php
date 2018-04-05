<?php

namespace App;

use App\Models\Deposit;
use App\Models\Payment;
use App\Models\Wallet;
use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'ref_login', 'skype', 'telegram', 'login', 'lower_login'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    function getCreatedAtAttribute($value){
        return Carbon::parse($value)->format('d.M.Y H:i');
    }

    public function myWallets(){
        return $this->hasOne(Wallet::class, 'user_id');
    }

    public function myPayments(){
        return $this->hasMany(Payment::class, 'user_id');
    }

    public function myDeposits(){
        return $this->hasMany(Deposit::class, 'user_id');
    }
}
