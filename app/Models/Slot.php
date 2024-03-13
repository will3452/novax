<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'is_available'
    ]; 

    public function user () {
        return $this->belongsTo(Driver::class, 'user_id'); 
    }
}
