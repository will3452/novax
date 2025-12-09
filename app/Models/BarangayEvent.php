<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangayEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "description",
        "date",
        "time",
        "location",
        "barangay_id",
        "author_id",
    ];

    protected $casts = [
        "date" => "date",
    ];

    public function barangay()
    {
        return $this->belongsTo(Barangay::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, "author_id");
    }
}
