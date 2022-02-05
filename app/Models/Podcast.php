<?php

namespace App\Models;

use App\Models\Traits\HasCover;
use Cartalyst\Tags\TaggableTrait;
use Cartalyst\Tags\TaggableInterface;
use App\Models\Traits\BelongsToAccount;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Podcast extends Model implements TaggableInterface
{
    use HasFactory,
        BelongsToAccount,
        HasCover,
        TaggableTrait;

    protected $with = [
        'cover',
    ];

    protected $fillable = [
        'title',
        'account_id',
        'user_id',
        'description',
        'credit',
        'type', // regular | premium
        'cost_type',
        'cost',
        'launch_at',
        'published_at',
    ];

    protected $casts = [
        'launch_at' => 'date',
    ];

    const TYPE_REGULAR = 'Regular';
    const TYPE_PREMIUM = 'Premium';
}