<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedPermissions extends Migration
{
    public function up()
    {
        $permissions = [
            'access record management',
            'access analysis and evaluation',
            'access financial statements',
            'access financial ratio',
            'access data settings',
            'access profie',
            'access system settings',
        ];



        foreach ($permissions as $permission) {
            \App\Models\Permission::create([
                'group'=>'permissions',
                'name'=>$permission
            ]);
        }
    }
}
