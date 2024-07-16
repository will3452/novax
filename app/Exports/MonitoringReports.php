<?php

namespace App\Exports;

use App\Models\Group;
use ErrorException;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;

class MonitoringReports implements FromArray
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function array(): array
    {
        $results = [
            ["PROGRAM", "SCHOOL YEAR", "TERM", "COURSE CODE/SECTION", "GROUP CODE", "GROUP MEMBERS", "THESIS|CAPSTONE TITLE", "RESEARCH AREA", "ADVISER", "PANEL CHAIR", "PANEL MEMBER", "RESEARCH TYPE", "DEFENSE SCHEDULE", "VERDICT"], 
        ];

        $groups = Group::whereHas('title', function ($query) {
            $query->whereHas('section', function ($query) {
                $query->whereTerm(nova_get_setting('term'))->where('school_year', nova_get_setting('school_year')); 
            }); 
        })->get();


        foreach($groups as $g) {
            $program = $g->groupMembers()->first()->student->course;  
            $members = $g->groupMembers->map(fn ($e) => $e->student->name)->toArray(); 
            $section = $g->title->section; 
            $adviser = "";
            $chair = "";
            $member = "";
            try {
                $adviser = $g->panellists()->whereType('Adviser')->first()->faculty->name;
                $chair = $g->panellists()->whereType('Chair')->first()->faculty->name;
                $member = $g->panellists()->whereType('Member')->first()->faculty->name;
            } catch (ErrorException $e) {
                $adviser = "";
                $chair = "";
                $member = "";
            }
            array_push($results, 
            [
                $program,
                nova_get_setting('school_year'),
                nova_get_setting('term'), 
                $section->section, 
                $g->code ?? 'N/a', 
                implode(", ", $members),
                $g->title->title, 
                $g->title->area_of_research, 
                $adviser, 
                $chair, 
                $member,
                $g->title->ic_type, 
                $g->defense_schedule, 
                '',  
            ]);
        }

        return $results; 
    }
}
