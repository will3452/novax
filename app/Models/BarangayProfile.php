<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangayProfile extends Model
{
    use HasFactory;

    protected $fillable = ["profile_id", "barangay_id", "is_active"];
}
