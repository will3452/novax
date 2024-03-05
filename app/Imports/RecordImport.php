<?php

namespace App\Imports;

use App\Models\Alumnus;
use Str;
use App\Models\User;
use App\Models\ProfessionalRecord;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RecordImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $name = $row['name_last_first_middle']; 
        $user = User::whereName("$name")->first(); 
        if (! $user) {
            $user = User::create(['name' => $name, 'password' => bcrypt('password'), 'email' => "user" . Str::random(5)."@alumni.example"]);
        }

        $alumni = Alumnus::whereUserId($user->id)->first();
        $arrName = explode(', ', $name);
        $lastName = $arrName[0];
        $firstName = $arrName[1];
        $middleName = $arrName[2] ?? ''; 
         $gender = $row['gender']; 
         $batch = $row['batch_year_month_eg_2023_jan']; 
         $birthday = $row['birthdate']; 
         $program = $row['program'];
         $status = $row['work_status_employedunemployed']; 
         $career = $row['career'];

         if (! $alumni) {
            $alumni = Alumnus::create([
                'gender' => $gender,
                 'batch' => $batch, 
                 'first_name' => $firstName,
                 'last_name' => $lastName,
                 'middle_name' => $middleName,
                 'birthday' => $birthday,
                 'program' => $program,
                 'employment_status' => $status, 
                 'soc_med' => "", 
            ]);
         }
        return new ProfessionalRecord([
            'scope' => $row['scope_localinternational'],
            'work_type' => $row['work_type_governmentngoprivate'],
            'is_private' => $row['is_private_1_if_yes_0_if_no'],
            'company' => $row['comany_name'],
            'company_address' => $row['company_address'],
            'is_aligned' => $row['is_aligned_1_if_yes_0_if_no'], 
            'alumnus_id' => $alumni->id, 
            'career' => $career, 
        ]);
    }
}
