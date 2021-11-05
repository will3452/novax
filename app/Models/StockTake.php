<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Observers\StockTakeObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StockTake extends Model
{
    use HasFactory;
    protected $guarded  = [];
    const INVENTORY_DESCREPANCY_NONE = "None";
    const INVENTORY_DESCREPANCY_SHRINKAGE = "Inventory shrinkage";
    const INVENTORY_DESCREPANCY_MISPLACED = "Misplaced inventory";
    const INVENTORY_DESCREPANCY_HUMAN_ERROR = "Human Error";
    const INVENTORY_DESCREPANCY_MISMANAGED_RETURNS = "Mismanaged returns";


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getDifferenceAttribute()
    {
        return $this->initial_number_of_stocks - $this->current_physical_count;
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    protected static function boot()
    {
        parent::boot();

        self::observe(StockTakeObserver::class);
    }
}
