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

            $this->userRepository->updateOrCreateUser($data);
            return "User update successfully";
        } else {
            $this->userRepository->updateOrCreateUser($data);
            return "User add successfully";
        }
    }


    public function getUsers($request)
    {
        return $this->userRepository->getUsers($request);
    }
}
