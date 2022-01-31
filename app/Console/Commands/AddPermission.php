<?php

namespace App\Console\Commands;

use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Console\Command;

class AddPermission extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:permission {permission_name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new permission';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $permissionName = $this->argument('permission_name');

        $permissions = [
            "view list: $permissionName",
            "view details: $permissionName",
            "create $permissionName",
            "update $permissionName",
            "delete $permissionName",
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'group'=>Str::plural($permissionName),
                'name'=>$permission,
            ]);
        }

        error_log($permissionName. 'permission has been created!');
        return 0;
    }
}
