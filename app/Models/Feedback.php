<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'profession', 
        'destination_id',
        'feedback', 
    ]; 

    public function destination () {
        return $this->belongsTo(Destination::class, 'destination_id'); 
    }
}
