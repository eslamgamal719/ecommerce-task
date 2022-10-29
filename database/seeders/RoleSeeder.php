<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleAdmin  = Role::create(['name' => 'admin']);
        $roleClient = Role::create(['name' => 'client']);

        $permissions = Permission::pluck('id', 'id')->all();
        $roleAdmin->syncPermissions($permissions);
    }
}
