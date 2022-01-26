<?php

namespace App\Models;

trait HasStatus {
    public function toggleStatus()
    {
        if ($this->status === static::STATUS_OPEN) {
            $this->update(['status' => static::STATUS_CLOSED]);
        } else {
            $this->update(['status' => static::STATUS_OPEN]);
        }
    }

    public function isOpen()
    {
        return $this->status === static::STATUS_OPEN;
    }
}
