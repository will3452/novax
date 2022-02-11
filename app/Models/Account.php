<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'gender',
        'country',
        'penname',
        'picture',
        'copyright_disclaimer',
    ];

    protected $with = [
        'books',
        'artScenes',
        'audioBooks',
        'podcasts',
        'songs',
        'films',
    ];

    protected $casts = [
        'approved_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function markAsApproved()
    {
        $this->approved_at = now();
        return $this->save();
    }

    public function books()
    {
        return $this->hasMany(Book::class);
    }

    public function artScenes()
    {
        return $this->hasMany(ArtScene::class);
    }

    public function audioBooks()
    {
        return $this->hasMany(AudioBook::class);
    }

    public function songs()
    {
        return $this->hasMany(Song::class);
    }

    public function films()
    {
        return $this->hasMany(Film::class);
    }

    public function podcasts()
    {
        return $this->hasMany(Podcast::class);
    }
}
