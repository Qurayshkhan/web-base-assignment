<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(){

        return view('roles.roles');

    }

    public function addRole(Request $request){


        $role = Role::create([
            'name' => $request->input('role_name'),
        ]);

        if ($request->permissions) {

            $role->syncPermissions([$request->permissions]);
        }

        return "Role Create successfully";
    }
}
