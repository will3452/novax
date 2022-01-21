<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expert extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'title',
        'about',
        'image',
        'contacts',
    ];

    protected $with = [
        'files'
    ];

    public function files()
    {
        return $this->hasMany(File::class, 'expert_id');
    }
}
