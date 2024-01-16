<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'lat',
        'lng',
        'description',
        'category_id',
        'entry_fees',
        'operating_hours',
        'best_time_to_visit',
        'nearby_accommodations', 
        'transportation',
        'accessibility',
        'weather', 
    ]; 

    protected $casts = [
        'nearby_accommodations' => 'array',
        'transportation' => 'array',
        'weather' => 'array',
    ]; 

    public function category () {
        return $this->belongsTo(Category::class); 
    }

    public function photographs () {
        return $this->hasMany(Photograph::class, 'destination_id'); 
    }
}
