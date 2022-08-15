<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    use HasFactory;
    protected $fillable = [
        'capacity',
        'plate_number',
        'company_name',
    ];
    public function users () {
        return $this->belongsToMany(User::class);
    }
}
