<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use DataTables;

class RoleController extends Controller
{
    public function index()
    {

        return view('roles.roles');
    }

    public function addRole(Request $request)
    {


        $role = Role::create([
            'name' => $request->input('role_name'),
        ]);

        if ($request->permissions) {

            $role->syncPermissions([$request->permissions]);
        }

        return "Role Create successfully";
    }


    public function getRolesWithPermission(Request $request, Role $role)
    {

        $roles = Role::with('permissions')->get();
        if ($request->ajax()) {
            $data = $roles;
            return DataTables::of($data)
            ->addColumn('permissions', function($row) {

                // Get the permissions for the current row and format them as badges with random colors
                $permissions = $row->permissions;
                $badges = $permissions->map(function ($permission) {


                    // Generate a random color for the badge
                    $colors = [
                        'primary',
                        'secondary',
                        'success',
                        'info',
                        'warning',
                        'danger',
                        'dark',
                    ];
                    $color = $colors[array_rand($colors)];
                    // Create the badge HTML
                    return '<span class="badge badge-' . $color . '">' . $permission->name . '</span>';
                })->implode(' ');
                return $badges;
            })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="" class="edit btn btn-primary btn-sm">Edit</a>';
                    $btn .= ' <a href="" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $btn;
                })->rawColumns(['action', 'permissions'])
                ->make(true);
        }
    }
}
