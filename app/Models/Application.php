<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'user_id',
        'reference',
        'monthly_payable',
    ];

    public function user () {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function logs () {
        return $this->hasMany(ApplicationLog::class, 'application_id');
    }

    const STATUS_DECLINED = 'DECLINED';
    const STATUS_FOR_APPROVAL = 'FOR APPROVAL';
    const STATUS_APPROVED = 'APPROVED';
    const STATUS_DONE = 'DONE';
}
