<?php

namespace App\Repositories;

use App\Models\Teacher;
use DataTables;;

class TeacherRepository{

    protected $teacher;
    public function __construct(Teacher $teacher)
    {
        $this->teacher = $teacher;
    }

    public function storeTeacher($data){



    }


    public function getTeachersList($request){

        if ($request->ajax()) {
            $data = $this->teacher->with('user')->get();
            return Datatables::of($data)
                ->addColumn('name', function ($row) {

                    return $row->user->name;
                })
                ->addColumn('email', function ($row) {

                    return $row->user->email;
                })
                ->addColumn('action', function ($row) {
                    $userId = $row->user->id;
                    $teacherId = $row->id;
                    $name = $row->user->name;
                    $email = $row->user->email;

                    $actionBtn =
                        '<a    onClick="editCollage(`' . $name . '`, `' . $email . '`, `' . $userId . '`, `' . $teacherId . '`, `' . $row->contact . '`, `' . $row->location . '`)" class="edit btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#collageModal">Edit</a>
                        <button class="delete btn btn-danger btn-sm" data-id="' . $teacherId . '">Delete</button>
                       ';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

    }


}
