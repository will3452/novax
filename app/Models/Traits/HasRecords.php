<?php

namespace App\Models\Traits;

use App\Models\User;
use App\Models\Module;
use App\Models\Record;
use App\Models\Activity;
use App\Models\Material;
use Illuminate\Support\Carbon;
use App\Helpers\Model as ModelHelper;
use Illuminate\Database\Eloquent\Model;

trait HasRecords {
    public function records()
    {
        if (self::class === User::class) {
            return $this->hasMany(Record::class, 'user_id');
        }

        return $this->morphMany(Record::class, 'model');
    }

    public function hasRecordOfUser(int $userId): bool
    {
        return $this->records()->whereUserId($userId)->count();
    }

    public function hasRecordOf(int $modelId, string $modelType=Module::class): bool
    {
        return $this->records()->where([
            'model_id' => $modelId,
            'model_type' => $modelType,
        ])->count();
    }

    public function isNotLocked(int $userId, $loop, $lists) : bool
    {
        if (User::findOrFail($userId)->type === User::TYPE_TEACHER) {
            return true;
        }

        if ($loop->first) {
            return true;
        }

        if ($this->hasRecordOfUser($userId)) {
            return true;
        }

        if ($lists[$loop->index - 1]->hasRecordOfUser($userId)) {
            return true;
        }

        return (! $this->hasRecordOfUser($userId)) && $lists[$loop->index - 1]->hasRecordOfUser($userId);
    }

    public function recordLink($userId = null, $lastId=false): string
    {
        if (is_null($userId)) {
            $userId = auth()->id();
        }
        $type = ModelHelper::getModel($this);
        $id = $this->id;
        if ($lastId) {
            return "/save-records/$type/$id/$userId?last-in-module=$lastId";
        }
        return "/save-records/$type/$id/$userId";
    }

    public function isTakeable($userId)
    {
        if (! $this->records()->whereUserId($userId)->count()) {
            return true;
        }

        if (get_class($this) === Activity::class && $this->category === Activity::CATEGORY_PROJECT) {
            return is_null($this->records()->whereUserId($userId)->first()->file);
        }
        return is_null($this->records()->whereUserId($userId)->first()->score);
    }

    public function getScore($userId)
    {
        if (! $this->hasRecordOfUser($userId)) {
            return 0;
        }

        return $this->records()->whereUserId($userId)->first()->score;
    }

    public function timeParser($time)
    {
        return explode(',', Carbon::parse($time)->format('H,i'));
    }

    public function hourToMinutes($time)
    {
        [$hr, $min] = $this->timeParser($time);
        $minInHr = $hr * 60;
        return $min + $minInHr;
    }

    public function isExpired(): bool
    {
        $record = $this->records()->whereUserId(auth()->id())->first();
        if (is_null($record)) {
            return false;
        }

        $timeTaken = now()->diffInMinutes($record->created_at);
        $timeLimit = $this->hourToMinutes($this->time_limit);
        return $timeLimit < $timeTaken;
    }
}
