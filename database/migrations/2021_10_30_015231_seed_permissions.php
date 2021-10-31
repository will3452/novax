<?php

use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Database\Migrations\Migration;

class SeedPermissions extends Migration
{

    public function generatePermission($resource)
    {
        $permissions = [
            "create $resource",
            "update $resource",
            "delete $resource",
            "view  $resource details",
            "view any $resource",
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                "name" => "$permission",
                "group" => Str::plural($resource),
            ]);
        }
    }
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $resources = [
            'module',
            'subject',
            'quiz',
            'exam',
            'question',
            'answer',
            'class',
        ];

        foreach ($resources as $resource) {
            $this->generatePermission($resource);
        }

        info('permission generated');
    }
}
