<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'body',
        'mental_description_id',
    ];

    public function mentalDescription()
    {
        return $this->belongsTo(MentalDescription::class, 'mental_description_id');
    }
}
