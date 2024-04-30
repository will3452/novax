<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'logo',
        'address',
        'description',
        'hte_id', 
    ]; 

    public function hte () {
        return $this->belongsTo(User::class, 'hte_id'); 
    }
}
