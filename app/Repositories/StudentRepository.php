<?php

namespace App\Repositories;

use App\Models\Student;
use App\Models\User;
use DataTables;
use Illuminate\Support\Facades\Auth;

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
                    $collageName = $row->collage->user->name ?? '';
                    $degreeTitle = $row->degree_title;
                    $rollNumber = $row->roll_number;
                    $studentCourseName = $row->courses->pluck('name')->toArray();
                    $courseNames = $row->courses->pluck('id')->toArray();

                    $actionBtn = "";
                        if (Auth::user()->can(\App\Helpers\Permissions::EDIT_STUDENT)) {
                            $actionBtn .= '<a onClick="editStudent(`' . $name . '`, `' . $email . '`, `' . $userId . '`, `' . $studentId . '`, `' . $row->contact . '`, `' . $row->location . '`, `' .  $collageId . '` , `' . implode(',', $courseNames) . '`, `' . $degreeTitle . '`, `' . $rollNumber . '`)" class="edit btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#studentModal">Edit</a> ';
                        }
                        if (Auth::user()->can(\App\Helpers\Permissions::VIEW_STUDENT)) {

                            $actionBtn .= '<button class="btn btn-secondary  btn-sm" onClick="viewStudent(`' . $name . '`, `' . $email . '`, `' . $userId . '`, `' . $studentId . '`, `' . $row->contact . '`, `' . $row->location . '`, `' .  $collageName  . '` , `' . implode(',', $studentCourseName) . '`, `' . $degreeTitle . '`, `' . $rollNumber . '`)" id="kt_drawer_example_basic_button">view</button>
                       ';

                        }
                        if (Auth::user()->can(\App\Helpers\Permissions::DELETE_STUDENT)) {
                            $actionBtn .= '
                        <button class="delete btn btn-danger btn-sm" data-id="' . $userId  . '">Delete</button>
                       ';
                        }

                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function updateOrCreateStudent($data)
    {

      $user = $this->user->updateOrCreate(
            ['id' => $data['user_id']],
            [
                'name' => $data['name'],
                'email' => $data['email'],
            ]


        );

        $student = $this->student->updateOrCreate(
            ['user_id' => $data['user_id']],

            [
                'user_id' => $user->id,
                'collage_id' => $data['collage_id'],
                'location' => $data['location'],
                'contact' => $data['contact'],
                'degree_title' => $data['degree_title'],
                'roll_number' => $data['roll_number'],
            ]
        );



        $courses = $data['course_id'];


        $student->courses()->detach();

        $student->courses()->attach($courses);

        return true;
    }
}
