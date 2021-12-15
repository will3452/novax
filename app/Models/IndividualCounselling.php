<?php
namespace App\Models;

use App\Observers\CounsellingObserver;
use Illuminate\Database\Eloquent\Builder;

class IndividualCounselling extends Counselling
{
    protected $table = 'counsellings';


    protected static function booted()
    {
        static::addGlobalScope('groupCounselling', function (Builder $builder) {
            $builder->whereType(Counselling::TYPE_INDIVIDUAL);
        });
    }

    public static function boot()
    {
        parent::boot();
        self::observe(CounsellingObserver::class);
    }
}
