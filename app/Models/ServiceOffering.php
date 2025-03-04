<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceOffering extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'service_id',
    ];

    public function service () {
        return $this->belongsTo(Service::class);
    }
    public function branch () {
        return $this->belongsTo(Branch::class);
    }
}
