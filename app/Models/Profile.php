<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'educational_level',
        'monthly_salary',
        'address',
        'id_1',
        'id_2',
        'mothers_name',
        'fathers_name',
        'work',
        'company',
        'school',
    ];

    public function user () {
        return $this->belongsTo(User::class);
    }
}
