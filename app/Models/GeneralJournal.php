<?php

namespace App\Models;

use App\Observers\GeneralJournalObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralJournal extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function remark()
    {
        $generalJournal = GeneralJournalRemark::find($this->general_journal_remark_id);

        if (!$generalJournal) {
            return '';
        }
        return $generalJournal->description;
    }

    protected static function boot()
    {
        parent::boot();

        self::observe(GeneralJournalObserver::class);
    }
}
