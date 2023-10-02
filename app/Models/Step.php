<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    use HasFactory;
    protected $fillable = [
        'step',
        'description',
        'image',
        'injury_id',
    ];

    public function injury()
    {
        return $this->belongsTo(Injury::class, 'injury_id');
    }
}
