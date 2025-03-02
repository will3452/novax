<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchAssignment extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'branch_id',
    ];

    public function branch () {
        return $this->belongsTo(Branch::class);
    }

    public function user () {
        return $this->belongsTo(User::class);
    }
}
