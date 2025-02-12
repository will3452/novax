<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'name',
        'location',
    ];

    public function branch () {
        return $this->belongsTo(Branch::class, 'branch_id');
    }
}
