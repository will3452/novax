<?php
namespace App\Models;

use App\Observers\CounsellingObserver;
use Illuminate\Database\Eloquent\Builder;

class GroupCounselling extends Counselling
{
    protected $table = 'counsellings';

    protected static function booted()
    {
        static::addGlobalScope('groupCounselling', function (Builder $builder) {
            $builder->whereType(Counselling::TYPE_GROUP);
        });
    }

    public static function boot()
    {
        parent::boot();
        self::observe(CounsellingObserver::class);
    }
}
