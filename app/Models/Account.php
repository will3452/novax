<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    protected $guarded = [];
    const NORMAL_BALANCE_DEBIT = "debit";
    const NORMAL_BALANCE_CREDIT = "credit";


    public static function getNormalBalance($account)
    {
        $hasAccount = self::where('name', $account)->first();
        if($hasAccount){
            return self::where('name', $account)->first()->normal_balance;
        }
    }
}
