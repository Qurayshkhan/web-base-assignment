<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{

    protected $userRepository;
    public function __construct(UserRepository $userRepository)
    {

        $this->userRepository = $userRepository;
    }


    public function createUpdateUser($request)
    {
        $data = $request->all();

        if ($data['id']) {
            $user = $this->userRepository->updateOrCreateUser($data);
            $user->syncRoles($data['role_id']);
            return "User update successfully";
        } else {
            $user = $this->userRepository->updateOrCreateUser($data);
            $user->syncRoles($data['role_id']);
            return "User add successfully";
        }
    }


    public function getUsers($request)
    {
        return $this->userRepository->getUsers($request);
    }

    public function deleteUser($id){

        return $this->userRepository->deleteUser($id);

    }
}
