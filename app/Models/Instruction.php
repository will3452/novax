<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instruction extends Model
{
    use HasFactory;
    protected $fillable = [
        'module_id',
        'image',
        'description',
        'name',
    ];

    public function module()
    {
       return $this->belongsTo(Module::class, 'module_id');
    }
}
