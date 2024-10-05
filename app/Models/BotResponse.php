<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BotResponse extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'category',
        'question',
        'answer',
    ];

    public function parent () {
        return $this->belongsTo(BotResponse::class, 'parent_id');
    }

    public function children () {
        return $this->hasMany(BotResponse::class, 'parent_id');
    }
}
