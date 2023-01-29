<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubTopic extends Model
{
    use HasFactory;

    protected $fillable = [
        'topic_id',
        'name',
        'description',
    ];


    public function topic () {
        return $this->belongsTo(Topic::class, 'topic_id');
    }
}
