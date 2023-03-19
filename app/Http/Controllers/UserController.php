<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{

    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;

    }

    public function index(){

        return view('users.home');

    }

    public function createUpdateUser(Request $request){

     return  $this->userService->createUpdateUser($request);

    }

    public function getUsersList(Request $request)
    {
        return $this->userService->getUsers($request);
    }

}
