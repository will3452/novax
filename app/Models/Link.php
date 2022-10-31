<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;
    protected $fillable = [
        'document_id',
        'link',
        'description',
    ];

    public function document () {
        return $this->belongsTo(Document::class);
    }
}
