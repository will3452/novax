<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepairLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'asset_id',
        'category_id',
        'type',
        'cost',
        'time',
    ];

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
