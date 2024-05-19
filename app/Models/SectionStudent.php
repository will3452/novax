<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionStudent extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'section_id',
        'status',
    ]; 

    public function student () {
        return $this->belongsTo(User::class, 'student_id'); 
    }

    public function section () {
        return $this->belongsTo(Section::class, 'section_id'); 
    }

    const STATUS_JOINED = 'JOINED';
    const STATUS_PENDING = 'PENDING'; 
}
