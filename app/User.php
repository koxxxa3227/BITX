<?php

namespace App;

use App\Models\Deposit;
use App\Models\DepositAccrued;
use App\Models\DepositRewards;
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
        return Carbon::parse($value)->format('d.m.Y H:i');
    }

    public function myWallets(){
        return $this->hasOne(Wallet::class);
    }

    public function myDeposits(){
        return $this->hasMany(Deposit::class);
    }

    public function refs(){
        return $this->belongsTo(User::class, 'ref_login', 'login');
    }

    public function reffer(){
        return $this->belongsTo(User::class, 'ref_login', 'lower_login');
    }

    public function depositsAccrued(){
        return $this->hasMany(DepositAccrued::class);
    }

    public function payments(){
        return $this->hasMany(Payment::class);
    }

    public function refPaymentsLastDay(){
        $day = Carbon::yesterday()->format('Y-m-d');
        return $this->hasMany(Payment::class)->whereType('Реферальное вознаграждение')->where('created_at', 'like' , "$day %");
    }

    public function userDepositStatusFalse(){
        return $this->hasMany(Deposit::class)->whereStatus('В обработке');
    }

    public function depositReward(){
        return $this->hasMany(DepositRewards::class);
    }
}
