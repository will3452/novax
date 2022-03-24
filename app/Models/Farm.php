<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farm extends Model
{
    use HasFactory;

    protected $fillable = [
        'crops',
        'barangay',
        'address',
        'total_farm_area',
        'coordinates',
        'land_owner',
        'tenure_type',
        'size',
        'is_organically_grown', //yes | no
        'source_of_water',
        'farmer_id',
        'color',
        'fill',
    ];

    const SOW_DEEP_WELL = 'Deep Well';
    const SOW_TUBE_WELL = 'Tube Well';

    public function farmer()
    {
        return $this->belongsTo(Farmer::class, 'farmer_id');
    }

    public function setPin($positions, $color, $fill)
    {
        $this->update([
            'coordinates' => $positions,
            'color' => $color,
            'fill' => $fill,
        ]);
    }
}
