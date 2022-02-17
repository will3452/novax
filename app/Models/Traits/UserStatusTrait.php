<?php

namespace App\Models\Traits;

trait UserStatusTrait
{
    public function isBlocked()
    {
        return $this->status === self::STATUS_BLOCKED;
    }

    public function block()
    {
        $this->update(['status' => self::STATUS_BLOCKED]);
    }

    public function isPending()
    {
        return $this->status === self::STATUS_PENDING;
    }

    public function active()
    {
        $this->update(['status' => self::STATUS_ACTIVE]);
    }

    public function isActived()
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    public function scopeActive($q)
    {
        return $q->whereStatus(self::STATUS_ACTIVE);
    }

    public function scopeBlocked()
    {
        return $q->whereStatus(self::STATUS_BLOCKED);
    }
}
