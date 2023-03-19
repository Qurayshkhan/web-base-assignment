<?php

namespace App\Repositories;

use App\Models\User;
use DataTables;


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
            $data = $this->user->with('role')->where('id', '!=', auth()->user()->id)->get();
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
}
