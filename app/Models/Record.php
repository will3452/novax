<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;

    protected $fillable = [
        'model_type',
        'model_id',
        'user_id',
        'score',
        'file', // project file
    ];

    protected $with = [
        'user',
    ];

    public function model()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getSubjectAttribute()
    {
        if (get_class($this->model) == Activity::class) {
            return optional(optional($this->model->module)->subject)->name;
        }

        return optional($this->model->subject)->name;
    }

    public function getRateAttribute()
    {
        $arr = explode("/", $this->score);
        $rate = 0;
        if (count($arr) == 2) {
            $calculatedRate = ($arr[0] / $arr[1]);
            $rate = $calculatedRate * 100;
        } else {
            $rate = $this->score;
        }
        return  number_format($rate, 2);
    }
}
