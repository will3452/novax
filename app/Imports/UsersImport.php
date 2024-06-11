<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    public $type;

    public function __construct($type)
    {
        $this->type = $type; 
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'name' => $row['name_sur_name_given_name_mi'], 
            'type' => $this->type, 
            'email' => $row['email'],
            'password' => bcrypt($row['password']),
            'number' => $row['id_no'], 
            'cluster' => $row['program_of_study_cluster'],
            'course' => $row['program_of_study_cluster'], 
        ]);
    }

    public function headingRow(): int
    {
        return 1;
    }
}
