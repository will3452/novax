<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        "order_id",
        "store_id",
        "product_category",
        "product_id",
        "cooperative",
        "product_name",
        "product_price",
        "order_quantity",
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'store_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public static function createFromOrderItemsBreakdown($orderId)
    {
        $e = Order::find($orderId)->itemsBreakdown;
        $fruits = explode("\n", $e);

        $result = [];

        foreach ($fruits as $f) {
            if (! strlen($f)) {
                continue;
            }


            [$id, $name, $price, $quantity] = explode("***", $f);

            $product = Product::find($id);
            if (is_null($product)) {
                continue;
            }
            $result[] = [
                "order_id" => $orderId,
                "store_id" => $product->store_id,
                "product_category" => $product->category,
                "cooperative" => optional($product->storeOwner)->cooperative,
                "product_id" => $id,
                "product_name" => $name,
                "product_price" => $price,
                "order_quantity" => $quantity,
                ];
        }

        foreach ($result as $r) {
            self::create($r);
        }
    }
}
