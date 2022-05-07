<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', // the user who encrypt
        'content', // .dat file or ecrypted file
        'type',
        'execution_time', // in miliseconds
    ];

    const TYPE_ENCRYPT = "Encrypted";
    const  TYPE_DECRYPT = "Decrypted";

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
