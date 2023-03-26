<?php

namespace App\Repositories;

use App\Models\Student;
use App\Models\User;
use DataTables;

class StudentRepository
{


    protected $user, $student;
    public function __construct(User $user, Student $student)
    {

        $this->user = $user;
        $this->student = $student;
    }

    public function getStudentList($request)
    {

        if ($request->ajax()) {
            $data = $this->student->with('user', 'courses')->get();
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
                    $studentId = $row->id;
                    $name = $row->user->name;
                    $email = $row->user->email;
                    $collageId = $row->collage_id;
                    $degreeTitle = $row->degree_title;
                    $rollNumber = $row->roll_number;
                    $courseNames = $row->courses->pluck('id')->toArray();

                    $actionBtn =
                        '<a    onClick="editStudent(`' . $name . '`, `' . $email . '`, `' . $userId . '`, `' . $studentId . '`, `' . $row->contact . '`, `' . $row->location . '`, `' .  $collageId . '` , `' . implode(',', $courseNames) . '`, `' . $degreeTitle . '`, `' . $rollNumber . '`)" class="edit btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#studentModal">Edit</a>
                        <button class="delete btn btn-danger btn-sm" data-id="' . $studentId . '">Delete</button>
                       ';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function updateOrCreateStudent($data)
    {

        $student = $this->student->updateOrCreate(
            ['user_id' => $data['user_id']],

            [
                'user_id' => $data['user_id'],
                'collage_id' => $data['collage_id'],
                'location' => $data['location'],
                'contact' => $data['contact'],
                'degree_title' => $data['degree_title'],
                'roll_number' => $data['roll_number'],
            ]
        );

        $this->user->updateOrCreate(
            ['id' => $data['user_id']],
            [
                'name' => $data['name'],
                'email' => $data['email'],
            ]


        );

        $courses = $data['course_id'];


        $student->courses()->detach();

        $student->courses()->attach($courses);

        return "Student update successfully";
    }
}
