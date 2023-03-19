<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    protected $userService, $roles;
    public function __construct(UserService $userService, Role $roles)
    {
        $this->userService = $userService;
        $this->roles = $roles;

    }

    public function index(){


        $roles = $this->roles->get();
        return view('users.home', compact('roles'));

    }

    public function createUpdateUser(UserRequest $request){

     return  $this->userService->createUpdateUser($request);

    }

    public function getUsersList(Request $request)
    {
        return $this->userService->getUsers($request);
    }

    public function destroy($user){

            return $this->userService->deleteUser($user);

    }

}
