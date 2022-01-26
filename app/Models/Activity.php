<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory, HasStatus;

    const STATUS_OPEN = 'Open';
    const STATUS_CLOSED = 'Closed';

    protected $fillable = [
        'module_id',
        'name',
        'user_id',//instructor
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function submissions()
    {
        return $this->hasMany(UserActivity::class);
    }
}
