<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangayAccess extends Model
{
    use HasFactory;
    const TYPE = ['Resident', 'Administrator', 'Staff'];
    protected $fillable = [
        'user_id',
        'barangay_id',
        'type',
    ];

    public function user () {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function barangay () {
        return $this->belongsTo(Barangay::class, 'barangay_id');
    }
}
