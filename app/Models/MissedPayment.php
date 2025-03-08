<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class MissedPayment extends PaymentSchedule
{
    protected $table = 'payment_schedules';

    protected static function booted()
    {
        static::addGlobalScope('missed_payments', function (Builder $query) {
            $query->where('due_date', '<', Carbon::today())
                  ->where('status', '!=', 'PAID');
        });
    }

    public function getTypeAttribute() {
        return $this->loan->type;
    }
}
