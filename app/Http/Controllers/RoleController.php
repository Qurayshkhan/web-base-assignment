<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {

        return view('roles.roles');
    }

    public function addRole(RoleRequest $request)
    {


        $role = Role::updateOrCreate(['id' => $request->id], [
            'name' => $request->input('role_name'),
        ]);

        if ($request->permissions) {

            $role->syncPermissions([$request->permissions]);
        }
        if ($request->id) {
            # code...
            return "Role update successfully";
        } else {
            return "Role create successfully";
        }
    }


    public function getRolesWithPermission(Request $request)
    {

        $roles = Role::with('permissions')->get();
        if ($request->ajax()) {
            $data = $roles;
            return DataTables::of($data)
                ->addColumn('permissions', function ($row) {

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
                    $btn = "";
                    if (Auth::user()->can(\App\Helpers\Permissions::EDIT_ROLE)) {
                        $btn .= '<a href="#" data-role-id="' . $row->id . '" class="edit btn btn-primary btn-sm">Edit</a>';
                    }
                    if (Auth::user()->can(\App\Helpers\Permissions::DELETE_ROLE)) {
                        $btn .= ' <a class="delete btn btn-danger btn-sm" data-id="' . $row->id . '">Delete</a>';
                    }

                    return $btn;
                })->rawColumns(['action', 'permissions'])
                ->make(true);
        }
    }




    public function edit(Role $role)
    {
        $permissions = Permission::all();
        $rolePermissions = $role->permissions->pluck('name')->toArray();
        return response()->json([
            'role' => $role,
            'permissions' => $permissions,
            'rolePermissions' => $rolePermissions,
        ]);
    }

    public function destroy($role)
    {

        return Role::findById($role)->delete();
    }
}
