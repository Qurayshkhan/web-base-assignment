<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
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


        $user = User::firstOrCreate(
            [
                'email' => 'admin@gmail.com'
            ],
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123'),
            ]

        );
        Role::firstOrCreate(['name' => 'Collage'], ['name' => 'Collage', 'user_id' => $user->id]);
        Role::firstOrCreate(['name' => 'Teacher'], ['name' => 'Teacher', 'user_id' => $user->id]);
        Role::firstOrCreate(['name' => 'Student'], ['name' => 'Student', 'user_id' => $user->id]);
        $admin = Role::firstOrCreate(['name' => 'Admin'], ['name' => 'Admin', 'user_id' => $user->id]);

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
                "create_collage",

                'student',
                'view_student',
                'edit_student',
                'create_student',
                'delete_student',

                'teacher',
                'view_teacher',
                'create_teacher',
                'edit_teacher',
                'delete_teacher',

                'course',
                'view_course',
                'edit_course',
                'create_course',
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
        $admin->syncPermissions($permissions);
        $user->syncRoles($admin);
    }
}
