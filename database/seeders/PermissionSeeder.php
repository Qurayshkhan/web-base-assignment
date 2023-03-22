<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = ['create_user', 'edit_user', 'view_user', 'delete_user'];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
