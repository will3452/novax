<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;
    protected $fillable = [
        'document_id',
        'description',
        'date',
    ];

    public function document () {
        return $this->belongsTo(Document::class);
    }

    protected $casts = ['date' => 'datetime'];
}
