<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = Permission::all();

        $role = Role::create([
            'id' => 1,
            'name' => 'superadmin',
            'guard_name' => 'web',
        ]);

        foreach ($permissions as $permission) {
            $role->givePermissionTo($permission->name);
        }
    }
}
