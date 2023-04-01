<?php

namespace App\Repositories;

use App\Helpers\Constants;
use App\Models\Collage;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserRepository
{

    protected $user, $collage, $student, $teacher;
    public function __construct(User $user, Collage $collage, Student $student, Teacher $teacher)
    {
        $this->user = $user;
        $this->collage = $collage;
        $this->teacher = $teacher;
        $this->student = $student;
    }

    public function updateOrCreateUser($data)
    {

        $user =  $this->user->updateOrCreate(['id' => $data['id']], $data);

        if ($data['user_type'] == Constants::COLLAGE) {

            $this->collage->updateOrCreate(['id' => $data['id']], ['user_id' => $user->id]);
        }

        if ($data['user_type'] == Constants::TEACHER) {

            $this->teacher->updateOrCreate(['id' => $data['id']], ['user_id' => $user->id]);
        }

        if ($data['user_type'] == Constants::STUDENT) {

            $this->student->updateOrCreate(['id' => $data['id']], ['user_id' => $user->id]);
        }

        return $user;
    }

    public function getUsers($request)
    {

        // return $this->user->where('id', '!=', auth()->user()->id)->get();

        if ($request->ajax()) {
            $data = $this->user->select('id', 'name', 'email', 'user_type' ,'created_at')->with('role:id,name')->where('id', '!=', auth()->user()->id)->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('role', function ($row) {

                    return $row->getRoleNames()->implode(', ');
                })
                ->addColumn('action', function ($row) {
                    $userId = $row->id;
                    $name = $row->name;
                    $email = $row->email;
                    $userType = $row->user_type;
                    $roleId = $row->roles()->pluck('id')->first();

                    $actionBtn = "";

                    if (Auth::user()->can(\App\Helpers\Permissions::EDIT_USER)) {
                        $actionBtn .= '<a    onClick="editUser(`' . $name . '`, `' . $email . '`, `' . $userId . '`, `' . $roleId . '`, `' . $userType . '`)" class="edit btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#userModal">Edit</a> ';
                    }
                    if (Auth::user()->can(\App\Helpers\Permissions::DELETE_USER)) {
                        $actionBtn .=  '<button class="delete btn btn-danger btn-sm" data-id="' . $userId . '">Delete</button>';
                    }

                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }


    public function deleteUser($id)
    {
        return $this->user->find($id)->delete();
    }

    public function userResetPassword($data)
    {

        $user = $this->user->where('email', $data['email'])->first();
        // dd($user);

        if ($user->remember_token != null) {
            # code...

            if ($user) {

                $user->update([

                    'remember_token' => null,
                    'password' =>   Hash::make($data['password'])

                ]);
            } else {

                return "User not found";
            }

            return "Your password is set successfully";
        } else {

            return "Your Link is Expired";
        }
    }
}
