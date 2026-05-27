<?php

namespace App\Models;

use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use App\Models\InventoryAudit;
use App\Services\GoogleSheetService;

class Product extends Model
{

    use HasFactory;

    public function getPidAttribute()
{
    $service = app(GoogleSheetService::class);

    $rows = $service->getRows('Sheet1!A2:C1000');

    if (!$rows) {
        return null;
    }

    foreach ($rows as $row) {

        $pid = $row[0] ?? null;
        $name = $row[2] ?? null;

        if ($name === $this->name) {
            return $pid;
        }

    }

    return null;
}
    const CATEGORY_SINGLE = "Single";
    const CATEGORY_BUNDLE = "Bundle";

    protected $fillable = [
        "name",
        "price",
        "category",
        "sheet_id",
        "card_set_category",
        "search_keyword",
        "image",
        "default_stock",
        "current_stock",
        "remarks",
        "is_archived",
        "stockout",
        "rarity",
        "card_set_treatment"
    ];

    protected static function boot()
    {
        parent::boot();

        // When product is created
        static::created(function ($product) {

            InventoryAudit::create([
                'product_id' => $product->id,
                'user_id' => Auth::id(),
                'card_name' => $product->name,
                'action' => 'created'
            ]);

        });

        // When product is updated
        static::updating(function ($product) {

            $dirty = $product->getDirty();

            if (empty($dirty)) {
                return;
            }

            $changes = [];

            foreach ($dirty as $field => $newValue) {

                $changes[$field] = [
                    'old' => $product->getOriginal($field),
                    'new' => $newValue
                ];
            }

            InventoryAudit::create([
                'product_id' => $product->id,
                'user_id' => auth()->id(),
                'card_name' => $product->name,
                'action' => 'edited',
                'changes' => json_encode($changes)
            ]);

        });

    }

    public function audits()
    {
        return $this->hasMany(InventoryAudit::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, "product_id");
    }

    public function predictions()
    {
        return $this->hasMany(Prediction::class, "product_id");
    }

    public function getBundleContents()
    {
        return Cache::remember('bundle_data', 3600, function () {
            $url = "https://docs.google.com/spreadsheets/d/e/2PACX-1vTTgTgpDAtnUajTrzTuH0Vqi62pfuJ0qLPlkE4yFjCY9c76eL6CCt2310nxwBMKp61BKfa85ZapwAbv/pub?output=csv";
            $csv = file_get_contents($url);
            $rows = array_map('str_getcsv', explode("\n", $csv));
            
            $data = [];
            foreach ($rows as $row) {
                // Assuming Column 0 is PID and Column 2 (Index 2) is Contents
                if (isset($row[0])) {
                    $data[$row[0]] = $row[2] ?? 'No contents listed';
                }
            }
            return $data;
        });
    }
    public function hasPendingOrder()
{
    return \App\Models\OrderItem::where('product_id', $this->id)
        ->whereHas('order', function ($q) {
            $q->where('status', \App\Models\Order::STATUS_PENDING);
        })
        ->exists();
}

}