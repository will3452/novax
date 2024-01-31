<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfessionalRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'alumnus_id', 
        'scope',
        'work_type',
        'is_private', 
        'company',
        'company_address',
        'is_aligned', 
    ]; 

    public function alumnus() {
        return $this->belongsTo(Alumnus::class, 'alumnus_id'); 
    }
}
