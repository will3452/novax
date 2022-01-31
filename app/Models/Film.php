<?php

namespace App\Models;

use App\Models\Traits\BelongsToAccount;
use App\Models\Traits\HasCover;
use App\Models\Traits\HasFreeArtScenes;
use Cartalyst\Tags\TaggableInterface;
use Cartalyst\Tags\TaggableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//TODO: upload film, published_button,
class Film extends Model implements TaggableInterface
{
    use HasFactory,
        HasCover,
        HasFreeArtScenes,
        BelongsToAccount,
        TaggableTrait;

    protected $fillable = [
        'title',
        'type', // film | trailer | animation
        'genre_id',
        'age_restriction',
        'language_id',
        'user_id',
        'account_id',
        'cost_type',
        'cost',
        'published_at',
        'credit',
        'description',
    ];

    const TYPE_FILM = 'Film';
    const TYPE_TRAILER = 'Trailer';
    const TYPE_ANIMATION = 'Animation';

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }
}
