<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SeedPermissionsList extends Migration
{
    public function up()
    {
        $permissions = [
            'access bookings',
            'access shops',
            'access roles',
            'access users',
        ];

        foreach ($permissions as $permission) {
            \App\Models\Permission::create([
                'group'=>'permissions',
                'name'=>$permission
            ]);
        }
    }
}
