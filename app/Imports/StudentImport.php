<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class StudentImport implements ToModel, WithStartRow
{
    public $password;

    public function getPassword()
    {
        if ($this->password == null) { # for the better performance
            $this->password = bcrypt('password');
            return $this->password;
        }

        return $this->password;
    }
    public function startRow(): int
    {
        return 2;
    }

    public function model(array $row)
    {
        return new User([
            'name' => $row[1],
            'school_id' => $row[0],
            'email' => $row[3],
            'study' => $row[2],
            'type' => User::TYPE_STUDENT,
            'password' => $this->getPassword(),
        ]);
    }

}
