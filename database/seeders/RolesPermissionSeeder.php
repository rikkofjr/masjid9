<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'role-list']);
        Permission::create(['name' => 'role-create']);
        Permission::create(['name' => 'role-edit']);
        Permission::create(['name' => 'role-delete']);
        Permission::create(['name' => 'bendahara-create']);
        Permission::create(['name' => 'bendahara-edit']);
        Permission::create(['name' => 'humas-edit']);
        Permission::create(['name' => 'humas-create']);
        Permission::create(['name' => 'outsource-create']);
        Permission::create(['name' => 'outsource-edit']);
        Permission::create(['name' => 'outsource-delete']);
        Permission::create(['name' => 'dkm-create']);
        Permission::create(['name' => 'dkm-edit']);
        Permission::create(['name' => 'dkm-delete']);

        // create roles and assign created permissions

        // this can be done as separate statements
        $role = Role::create(['name' => 'Admin']);
        $role->givePermissionTo(Permission::all());

        $role = Role::create(['name' => 'DKM-Bendahara'])
        ->givePermissionTo(['bendahara-create', 'bendahara-edit', 'outsource-create', 'outsource-edit', 'outsource-delete']);

        $role = Role::create(['name' => 'DKM-Humas'])
        ->givePermissionTo(['humas-edit', 'humas-create']);

        $role = Role::create(['name' => 'DKM'])
        ->givePermissionTo(['bendahara-create', 'bendahara-edit', 'humas-edit', 'humas-create' ]);
        
        $role = Role::create(['name' => 'Outsource Staf'])
        ->givePermissionTo(['outsource-create', 'outsource-edit']);
        
        $role = Role::create(['name' => 'Outsource Head'])
        ->givePermissionTo(['outsource-create', 'outsource-edit', 'outsource-edit']);

    }
}
