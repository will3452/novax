<?php

namespace App\Models;

use App\Models\Traits\HasArtFile;
use Cartalyst\Tags\TaggableTrait;
use Cartalyst\Tags\TaggableInterface;
use App\Models\Traits\BelongsToAccount;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ArtScene extends Model implements TaggableInterface
{
    use HasFactory,
        BelongsToAccount,
        HasArtFile,
        TaggableTrait;

    protected $fillable = [
        'title',
        'description',
        'account_id',
        'user_id',
        'lead_college',
        'credits',
        'cost',
        'cost_type',
        'genre_id',
        'age_restriction',
        'published_at',
    ];

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }
}