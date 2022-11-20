<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_id',
        'name',
        'address',
        'email',
        'cpno',
        'logo',
        'user_id',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
