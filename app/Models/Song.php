<?php

namespace App\Models;

use App\Models\Traits\BelongsToAccount;
use App\Models\Traits\HasCover;
use Cartalyst\Tags\TaggableInterface;
use Cartalyst\Tags\TaggableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model implements TaggableInterface
{
    use HasFactory,
        TaggableTrait,
        BelongsToAccount,
        HasCover;

    protected $with = [
            'cover',
        ];

    protected $fillable = [
        'title',
        'user_id',
        'account_id',
        'genre_id',
        'description',
        'credit',
        'cost_type',
        'cost',
        'lyrics',
        'copyright',
        'not_yet_copyrighted',
        'published_at',
    ];

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }
}