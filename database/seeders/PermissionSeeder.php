<?php

namespace Database\Seeders;

use App\Helpers\Constants;
use App\Models\Collage;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
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
    public function run(User $user, Hash $hash)
    {

        $user = User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'admin',
                'password' => $hash::make('admin123'),
            ]
        );

        $collageUser = User::updateOrCreate(
            ['email' => 'collage@gmail.com'],
            [
                'name' => 'collage',
                'password' => $hash::make('collage123'),
                'user_type' => Constants::COLLAGE
            ]
        );
        $collage = Collage::updateOrCreate(
            ['user_id' => $collageUser->id],
            ['user_id' => $collageUser->id]
        );

        $teacherUser = User::updateOrCreate(
            ['email' => 'teacher@gmail.com'],
            [
                'name' => 'teacher',
                'password' => $hash::make('teacher123'),
                'user_type' => Constants::TEACHER
            ]
        );
        $teacher = Teacher::updateOrCreate(
            ['user_id' => $teacherUser->id],
            ['collage_id' => $collage->id]
        );

        $studentUser = User::updateOrCreate(
            ['email' => 'student@gmail.com'],
            [
                'name' => 'student',
                'password' => $hash::make('student123'),
                'user_type' => Constants::STUDENT
            ]
        );
        $student = Student::updateOrCreate(
            ['user_id' => $studentUser->id],
            [
                'teacher_id' => $teacher->id,
                'collage_id' => $collage->id
            ]
        );

        $collageRole = Role::firstOrCreate(['name' => 'Collage'], ['name' => 'Collage', 'user_id' => $user->id]);
        $teacherRole = Role::firstOrCreate(['name' => 'Teacher'], ['name' => 'Teacher', 'user_id' => $user->id]);
        $studentRole = Role::firstOrCreate(['name' => 'Student'], ['name' => 'Student', 'user_id' => $user->id]);
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
        $collageUser->syncRoles($collageRole);
        $teacherUser->syncRoles($teacherRole);
        $studentUser->syncRoles($studentRole);
    }
}
