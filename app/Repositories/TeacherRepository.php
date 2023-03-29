<?php

namespace App\Repositories;

use App\Helpers\Constants;
use App\Helpers\Permissions;
use App\Models\Course;
use App\Models\Teacher;
use App\Models\User;
use DataTables;
use Illuminate\Support\Facades\Auth;

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

        $user = $this->user->updateOrCreate(
            ['id' => $data['user_id']],
            [
                'name' => $data['name'],
                'email' => $data['email'],
                "remember_token" => $data['remember_token'],
            ]


        );


        $teacher = $this->teacher->updateOrCreate(
            ['user_id' => $data['user_id']],

            [
                'user_id' => $user->id,
                'collage_id' => $data['collage_id'],
                'location' => $data['location'],
                'contact' => $data['contact'],
                'user_type' => Constants::TEACHER
            ]
        );


        $courses = $data['course_name'];


        $teacher->courses()->detach();

        $teacher->courses()->attach($courses);

        return $user;
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

                    $actionBtn = "";
                    if (Auth::user()->can(Permissions::EDIT_TEACHER)) {
                        $actionBtn .= '<a onClick="editTeacher(`' . $name . '`, `' . $email . '`, `' . $userId . '`, `' . $teacherId . '`, `' . $row->contact . '`, `' . $row->location . '`, `' .  $collageId . '` , `' . implode(',', $courseNames) . '`)" class="edit btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#teacherModal">Edit</a> ';
                    }

                    if (Auth::user()->can(Permissions::DELETE_TEACHER)) {
                        $actionBtn .= '<button class="delete btn btn-danger btn-sm" data-id="' . $userId . '">Delete</button>
                        ';
                    }

                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }


    public function teacherDelete($teacher)
    {

        return $this->user->find($teacher)->delete();
    }
}
