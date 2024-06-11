<?php

namespace App\Nova\Actions;

use App\Models\Section;
use Illuminate\Bus\Queueable;
use App\Models\SectionStudent;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use OptimistDigital\MultiselectField\Multiselect;
use Brightspot\Nova\Tools\DetachedActions\DetachedAction;

class InviteStudent extends DetachedAction
{
    use InteractsWithQueue, Queueable;

    public $sectionId; 

    public function __construct(int $sectionId)
    {
        $this->sectionId = $sectionId; 
    }

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields)
    {
        foreach(json_decode($fields['students']) as $student) {
            $exists = SectionStudent::where([
                'student_id' => $student, 
                'section_id' => $this->sectionId,
            ])->exists();
            if ($exists) {
                return DetachedAction::danger('student has already invitation'); 
            }
            SectionStudent::create([
                'student_id' => $student, 
                'section_id' => $this->sectionId,
            ]); 
        }
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [
            // Select::make('Student', 'student_id')
            //     ->options(\App\Models\User::whereType(\App\Models\User::TYPE_STUDENT)->get()->pluck('name', 'id'))
            //     ->searchable(), 
            Multiselect::make('Students')
                ->options(\App\Models\User::whereType(\App\Models\User::TYPE_STUDENT)->get()->pluck('name', 'id')), 
        ];
    }
}
