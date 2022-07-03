<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'model_type',
        'model_id',
    ];

    public function model () {
        return $this->morphTo();
    }
}
