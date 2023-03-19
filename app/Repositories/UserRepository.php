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
            $data = $this->user->where('id', '!=', auth()->user()->id)->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="" class="edit btn btn-success btn-sm">Edit</a> <a href="" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
