<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangayFacility extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "description",
        "category",
        "capacity",
        "cover_image",
        "status",
        "barangay_id",
    ];

    public function barangay()
    {
        return $this->belongsTo(Barangay::class);
    }
}
