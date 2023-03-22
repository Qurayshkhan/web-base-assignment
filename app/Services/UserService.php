<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Str;

class UserService
{

    protected $userRepository, $emailService;
    public function __construct(UserRepository $userRepository, EmailService  $emailService)
    {

        $this->userRepository = $userRepository;
        $this->emailService = $emailService;
    }


    public function createUpdateUser($request)
    {

        $token =   Str::random(20);
        $data = [
            'id' => $request->id,
            'role_id' => $request->role_id,
            "remember_token" => $token,
            "email" => $request->email,
            "name" => $request->name,
        ];
        if ($data['id']) {
            $user = $this->userRepository->updateOrCreateUser($data);
            $user->syncRoles($data['role_id']);
            return "User update successfully";
        } else {
            $user = $this->userRepository->updateOrCreateUser($data);
            $url = '/reset-password/' . $token . '/' . $user->email;
            $this->emailService->resetPasswordEmail($user, $url);
            $user->syncRoles($data['role_id']);
            return "User add successfully";
        }
    }


    public function getUsers($request)
    {
        return $this->userRepository->getUsers($request);
    }

    public function deleteUser($id)
    {

        return $this->userRepository->deleteUser($id);
    }

    public function userResetPassword($data)
    {

        $data = [

            'remember_token' => $data['token'],
            'email' => $data['email'],
            'password' => $data['password']

        ];

        return $this->userRepository->userResetPassword($data);
    }
}
