<?php

namespace App\Models;

use App\Models\Traits\HasKey;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory, HasKey;

    protected $fillable = [
        'user_id', // the user who encrypt
        'content', // .dat file or ecrypted file
        'type',
        'execution_time', // in miliseconds
        'key'
    ];

    const TYPE_ENCRYPT = "Encrypted";
    const  TYPE_DECRYPT = "Decrypted";

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
