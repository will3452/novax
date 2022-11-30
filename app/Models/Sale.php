<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sale extends Transaction
{
    use HasFactory;
    protected $table = 'transactions';

    protected static function booted()
    {
        static::addGlobalScope('ancient', function (Builder $builder) {
            $etypes = TransactionType::whereType(TransactionType::TYPE_INCOME)->select('id')->get()->map ( fn ($e) => $e->id)->all();
            $builder->whereIn('type_id', $etypes);
        });
    }
}
