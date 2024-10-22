<?php

namespace App\Imports;

use App\Models\Member;
use Maatwebsite\Excel\Concerns\ToModel;
class MemberImport implements ToModel
{

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
        return new Member([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'middle_name' => $middle_name ?? '',
            'address' => $row[1],
            'status' => strtolower($row[2] ?? 'in-active'),
        ]);
    }
}
