<?php

namespace App\Models;

use App\Models\Traits\HasCover;
use App\Models\Traits\BookTrait;
use Cartalyst\Tags\TaggableTrait;
use App\Models\Traits\HasLargeFile;
use Cartalyst\Tags\TaggableInterface;
use App\Models\Traits\BelongsToAccount;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasReviewQuestion;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AudioBook extends Model implements TaggableInterface
{
    use HasFactory,
        BelongsToAccount,
        TaggableTrait,
        HasCover,
        BookTrait,
        HasLargeFile,
        HasReviewQuestion;

    protected $with = [
        'cover',
    ];

    protected $fillable = [
        'user_id',
        'account_id',
        'title',
        'age_restriction',
        'category_id',
        'credit',
        'blurb',
        'language_id',
        'genre_id',
        'violence_level_id',
        'heat_level_id',
        'type',
        'cost',
        'cost_type',// ref. to the CrystalHelper
        'lead_character',
        'lead_college',
        'published_at',
    ];

    const TYPE_REGULAR = 'Regular';
    const TYPE_PREMIUM = 'Premium';
    const TYPE_SPIN = 'Spin';
    const TYPE_EVENT = 'Event';
}
