<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngredientInventory extends Model
{
    use HasFactory;

    const TYPE_PURCHASE = 'Purchase';
    const TYPE_USAGE = 'Usage';

    protected $fillable = [
        'ingredient_id',
        'type',
        'quantity', 
    ];

    public function ingredient () {
        return $this->belongsTo(Ingredient::class, 'ingredient_id'); 
    }
}
