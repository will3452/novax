<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Expense extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'project_id',
        'category_id',
        'date',
        'amount',
        'description',
    ];

    protected static $logAttributes = [
        'project_id',
        'category_id',
        'date',
        'amount',
        'description',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function receipts()
    {
        return $this->hasMany(Receipt::class, 'expense_id');
    }
}
