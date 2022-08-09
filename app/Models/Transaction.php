<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'model_type',
        'model_id',
        'hash',
        'verified',
    ];

    public function model () {
        return $this->morphTo();
    }
}
