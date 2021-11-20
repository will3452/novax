<?php

namespace Database\Seeders;

use App\Models\Exam;
use App\Models\Quiz;
use App\Models\Answer;
use App\Models\Module;
use App\Models\Subject;
use App\Models\Question;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subject::factory(5)->create();
        Module::factory(50)->create();
        Exam::factory(100)->create();
        Quiz::factory(200)->create();
        Question::factory(500)->create();
        Answer::factory(1000)->create();
    }
}
