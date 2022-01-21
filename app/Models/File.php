<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    protected $fillable = [
        'expert_id',
        'file',
        'title',
    ];

    public function expert()
    {
        return $this->belongsTo(Expert::class);
    }
}
