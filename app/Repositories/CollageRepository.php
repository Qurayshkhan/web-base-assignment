<?php


namespace App\Repositories;

use App\Models\Collage;
use App\Models\User;
use DataTables;

class CollageRepository
{

    protected $user, $collage;

    public function __construct(User $user, Collage $collage)
    {
        $this->user = $user;
        $this->collage = $collage;
    }

    public function updateCollageInformation($data)
    {

        if ($data['collage_id']) {
            $this->collage->updateOrCreate(
                [
                    'id' => $data['collage_id']
                ],
                $data
            );

            return "Collage update successfully";
        }else{

            return "Collage add successfully";
        }


    }

    public function getCollageList($request)
    {

        if ($request->ajax()) {
            $data = $this->collage->with('user')->get();
            return Datatables::of($data)
                ->addColumn('name', function ($row) {

                    return $row->user->name;
                })
                ->addColumn('email', function ($row) {

                    return $row->user->email;
                })
                ->addColumn('action', function ($row) {
                    $userId = $row->user->id;
                    $collageId = $row->id;
                    $name = $row->user->name;
                    $email = $row->user->email;

                    $actionBtn =
                        '<a    onClick="editCollage(`' . $name . '`, `' . $email . '`, `' . $userId . '`, `' . $collageId . '`, `' . $row->contact . '`, `' . $row->location . '`)" class="edit btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#collageModal">Edit</a>
                        <button class="delete btn btn-danger btn-sm" data-id="' . $collageId . '">Delete</button>
                       ';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
