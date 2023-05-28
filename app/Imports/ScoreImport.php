<?php

namespace App\Imports;

use App\Models\Activity;
use App\Models\Score;
use App\Models\Student;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ScoreImport implements ToCollection
{
    public $activity;
    public function __construct(Activity $activity)
    {
        $this->activity = $activity;
    }
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            $student = Student::whereName($row[0])->first();
            if ($student) {
                Score::create([
                    'score' => $row[1],
                    'max_score' => $this->activity->max_score,
                    'student_id' => $student->id,
                    'teaching_load_id' => $this->activity->teaching_load_id,
                    'activity_id' => $this->activity->id,
                ]);
            }
        }
    }
}
