<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        Role::firstOrCreate(['name' => 'Collage'], ['name' => 'Collage']);
        Role::firstOrCreate(['name' => 'Teacher'], ['name' => 'Teacher']);
        Role::firstOrCreate(['name' => 'Student'], ['name' => 'Student']);
        Role::firstOrCreate(['name' => 'Admin'], ['name' => 'Admin']);

        $permissions =
            [
                'user',
                'create_user',
                'edit_user',
                'view_user',
                'delete_user',


                'collage',
                'view_collage',
                'edit_collage',
                'delete_collage',

                'student',
                'view_student',
                'edit_student',
                'delete_student',

                'teacher',
                'view_teacher',
                'edit_teacher',
                'delete_teacher',

                'course',
                'view_course',
                'edit_course',
                'delete_course',
                'upload_file',


                'roles',
                'view_role',
                'create_role',
                'edit_role',
                'delete_role'

            ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
