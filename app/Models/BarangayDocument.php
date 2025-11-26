<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangayDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'document_id',
        'barangay_id',
        'fee',
        'processing_period',
    ];

    public function document () {
        return $this->belongsTo(Document::class, 'document_id');
    }

    public function barangay () {
        return $this->belongsTo(Barangay::class, 'barangay_id');
    }
}
