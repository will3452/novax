<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supervision extends Model
{
    use HasFactory;

    public $fillable = [
        'head_id',
        'member_id',
    ]; 

    public function head () {
        return $this->belongsTo(User::class, 'head_id');
    }

    
    public function member () {
        return $this->belongsTo(User::class, 'member_id');
    }
}
