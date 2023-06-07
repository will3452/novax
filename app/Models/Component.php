<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    use HasFactory;

    protected $fillable = [
        "image",
        "name",
        "category_id",
        "serial",
        "bound",
        "status",
        "condition_id",
        "purchase_at",
        "purchase_cost",
        "manufacturer_id",
        "supplier_id",
        "model_id",
        "user_id",
        "asset_id",
    ];

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assetModel()
    {
        return $this->belongsTo(AssetModel::class, 'model_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function condition()
    {
        return $this->belongsTo(Condition::class);
    }

}
