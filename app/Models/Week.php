<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Week extends Model
{
    use HasFactory;

    protected $fillable = [
        'difficulty_id',
        'sequence',
    ];

    protected $with = [
        'meals',
        'exercises',
    ];

    public function difficulty()
    {
       return $this->belongsTo(Difficulty::class, 'difficulty_id');
    }

    public function modules()
    {
       return $this->hasMany(Module::class);
    }

    public function exercises()
    {
       return $this->hasMany(Exercise::class, 'week_id');
    }

    public function meals()
    {
       return $this->hasMany(Meal::class, 'week_id');
    }

    public function getAvailableDays(string $type = Module::TYPE_EXERCISE)
    {
       $existing = [];

       if ($type === Module::TYPE_EXERCISE) {
           $existing = $this->exercises()->get()->pluck('day')->toArray();
       } else if ($type === Module::TYPE_MEAL) {
            $existing = $this->meals()->get()->pluck('day')->toArray();
       }

       array_unique($existing);

       $data = collect(Module::DAY_OPTIONS)->flatten()->keys()->toArray();

       $options = array_diff($data, $existing);

       return collect(Module::DAY_OPTIONS)->flatten()->filter(fn ($item, $index) => in_array($index, $options))->all();
    }

    //actions
    public function resetProgress()
    {
       $modules = $this->modules()->get()->only('id');
       $progress = UserModule::whereUserId(auth()->id())->whereBetween('module_id', $modules->toArray())->get();

       foreach ($progress as $item) {
           $item->delete();
       }
    }
}
