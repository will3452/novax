<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference_number',
        'insurance_details',
        'user_id', // patient
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function testItems()
    {
        return $this->hasMany(TestItem::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'model');
    }
}
