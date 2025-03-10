<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    use HasFactory;
    protected $fillable = [
        'description',
        'amount',
        'branch_id',
    ];

    public function branch () {
        return $this->belongsTo(Branch::class);
    }
}
