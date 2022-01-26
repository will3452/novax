<?php

namespace App\Models;

use App\Models\Contracts\Attemptable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory, HasQuestions, HasStatus;

    const STATUS_OPEN = 'Open';
    const STATUS_CLOSED = 'Closed';

    protected $fillable = [
        'module_id',
        'name',
        'status',
        'user_id',//instructor
    ];

    protected $with = [
        'questions',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
