<?php

namespace App\Models;

use App\Observers\GeneralJournalRemarkObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralJournalRemark extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function transactions()
    {
        return $this->hasMany(GeneralJournal::class);
    }

    protected static function boot()
    {
        parent::boot();

        self::observe(GeneralJournalRemarkObserver::class);
    }
}
