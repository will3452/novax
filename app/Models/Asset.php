<?php

namespace App\Models;

use App\Observers\AssetObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        'purchase_date'=>'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function boot()
    {
        parent::boot();

        self::observe(AssetObserver::class);
    }
}
