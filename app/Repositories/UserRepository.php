<?php

namespace App\Repositories;

use App\Models\User;
use DataTables;
use Illuminate\Support\Facades\Hash;

class UserRepository
{

    protected $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function updateOrCreateUser($data)
    {

        return $this->user->updateOrCreate(['id' => $data['id']], $data);
    }

    public function getUsers($request)
    {

        // return $this->user->where('id', '!=', auth()->user()->id)->get();

        if ($request->ajax()) {
            $data = $this->user->select('id', 'name', 'email', 'created_at')->with('role:id,name')->where('id', '!=', auth()->user()->id)->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('role', function ($row) {

                    return $row->getRoleNames()->implode(', ');
                })
                ->addColumn('action', function ($row) {
                    $userId = $row->id;
                    $name = $row->name;
                    $email = $row->email;
                    $roleId = $row->roles()->pluck('id')->first();

                    $actionBtn =
                        '<a    onClick="editUser(`' . $name . '`, `' . $email . '`, `' . $userId . '`, `' . $roleId . '`)" class="edit btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#userModal">Edit</a>
                        <button class="delete btn btn-danger btn-sm" data-id="' . $userId . '">Delete</button>
                       ';
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
