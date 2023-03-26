<?php

namespace App\Repositories;

use App\Models\Course;
use App\Models\Teacher;
use App\Models\User;
use DataTables;

class TeacherRepository
{

    protected $teacher, $course, $user;
    public function __construct(Teacher $teacher, Course $course, User $user)
    {
        $this->teacher = $teacher;
        $this->course = $course;
        $this->user = $user;
    }

    public function storeTeacher($data)
    {

        $teacher = $this->teacher->updateOrCreate(
            ['user_id' => $data['user_id']],

            [
                'user_id' => $data['user_id'],
                'collage_id' => $data['collage_id'],
                'location' => $data['location'],
                'contact' => $data['contact']
            ]
        );

        $this->user->updateOrCreate(
            ['id' => $data['user_id']],
            [
                'name' => $data['name'],
                'email' => $data['email'],
            ]


        );

        $courses = $data['course_name'];


        $teacher->courses()->detach();

        $teacher->courses()->attach($courses);

        return "Teacher update successfully";
    }


    public function getTeachersList($request)
    {

        if ($request->ajax()) {
            $data = $this->teacher->with('user', 'courses')->get();
            return Datatables::of($data)
                ->addColumn('name', function ($row) {

                    return $row->user->name;
                })
                ->addColumn('email', function ($row) {

                    return $row->user->email;
                })
                ->addColumn('courses', function ($row) {
                    $courses = $row->courses->pluck('name')->toArray();
                    return implode(', ', $courses);
                })
                ->addColumn('action', function ($row) {
                    $userId = $row->user->id;
                    $teacherId = $row->id;
                    $name = $row->user->name;
                    $email = $row->user->email;
                    $collageId = $row->collage_id;
                    $courseNames = $row->courses->pluck('id')->toArray();

                    $actionBtn =
                        '<a    onClick="editTeacher(`' . $name . '`, `' . $email . '`, `' . $userId . '`, `' . $teacherId . '`, `' . $row->contact . '`, `' . $row->location . '`, `' .  $collageId . '` , `' . implode(',', $courseNames) . '`)" class="edit btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#teacherModal">Edit</a>
                        <button class="delete btn btn-danger btn-sm" data-id="' . $teacherId . '">Delete</button>
                       ';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
