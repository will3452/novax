<?php

namespace App\Imports;

use App\Models\Attendance;
use App\Models\Member;
use App\Models\Program;
use Maatwebsite\Excel\Concerns\ToModel;

class AttendanceImport implements ToModel
{
    public $date;
    public function __construct($date)
    {
        $this->date = $date;
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $arr = explode(',', $row[0]);
        // dd($arr);
        $last_name = $arr[0];
        $first_name = array_key_exists(1, $arr) ? $arr[1] : '';
        $middle_name = array_key_exists(2, $arr) ? $arr[2] : '';
        if (strlen($last_name) == 0 || strlen($first_name) == 0) return;
        $member = Member::whereLastName($last_name)->whereFirstName($first_name)->first();
        $program = Program::whereDate('date', '=', $this->date)->first();

        if (! $member) {
            $member = Member::create([
                'first_name' => $first_name,
                'last_name' => $last_name,
                'middle_name' => $middle_name ?? '',
                'address' => '----',
                'status' => 'in-active',
            ]);
        }

        if (! $program) {
            $program = Program::create([
                'date' => $this->date,
            ]);
        }
        return new Attendance([
            'date' => $this->date,
            'member_id' => $member->id,
            'program_id' => $program->id,
        ]);
    }
}
