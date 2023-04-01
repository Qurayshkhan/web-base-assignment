<?php

namespace App\Http\Controllers;

use App\Helpers\Constants;
use App\Http\Requests\ResetPasswordRequest;
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

        // $this->middleware(['role_or_permission:user']);
    }

    public function index()
    {


        $roles = $this->roles->get();
        return view('users.users', compact('roles'));
    }

    public function resetPassword()
    {

        return view('auth.passwords.reset');
    }

    public function createUpdateUser(UserRequest $request)
    {

        return  $this->userService->createUpdateUser($request);
    }

    public function getUsersList(Request $request)
    {
        return $this->userService->getUsers($request);
    }

    public function destroy($user)
    {

        return $this->userService->deleteUser($user);
    }


    // Password reset controller method
    public function resetPasswordRequest(ResetPasswordRequest $request)
    {

        $user = $this->userService->userResetPassword($request->all());

        if ($user == Constants::PASSWORD_SET_SUCCESS) {

            return redirect()->route('login');
        } else {
            return redirect()->back()->with('status', $user);
        }


        // return view('auth.login');

    }
}
