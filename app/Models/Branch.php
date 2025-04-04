<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'address',
        'phone',
        'sales_current_invoice_number',
        'service_current_invoice_number',
    ];

    public function users () {
        return $this->belongsToMany(User::class, 'branch_assignments', 'branch_id', 'user_id');
    }
}
