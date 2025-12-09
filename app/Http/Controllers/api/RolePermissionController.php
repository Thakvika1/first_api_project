<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use App\Models\PermissionFeature;
use App\Models\RolePermission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RolePermissionController extends Controller
{
    public function index($role_id)
    {
        $role = Role::find($role_id);

        if (!$role) {
            return response()->json([
                'status' => 'error',
                'message' => 'Role Id not found'
            ], 404);
        }

        $permissions = Permission::query()
            ->select(
                'id',
                'name as permission_name',
            )
            ->with('permissionFeatures', function ($query) {
                $query->select(
                    'id',
                    'permission_id',
                    'name',
                    DB::raw("0 as have_permission"),
                );
            })
            ->get();

        $rolePermissions = $role->rolePermissions()->get();

        foreach ($rolePermissions as $index => $rp) {
            foreach ($permissions as $x => $p) {
                if ($rp->permission_id == $p->id) {
                    foreach ($p->permissionFeatures as $j => $feature) {
                        if ($rp->permission_feature_id == $feature->id) {
                            $permissions[$x]->permissionFeatures[$j]->have_permission = 1;
                        }
                    }
                }
            }
        }

        return response()->json([
            'status' => 'success',
            'role_permissions' => $permissions,
        ], 200);
    }

    public function setPermission(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'role_id' => 'required|integer|exists:roles,id',
            'permission_id' => 'required|integer|exists:permissions,id',
            'permission_feature_id' => 'required|exists:permission_features,id|array',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validate->errors()
            ], 422);
        }

        $data = $validate->validated();


        // test 
        // foreach ($data['permission_id'] as $permission_id) {
        //     $role_permission = RolePermission::where([
        //         'role_id' => $data['role_id'],
        //         'permission_id' => $permission_id,
        //     ]);
        // }



        foreach ($data['permission_feature_id'] as $value) {
            $role_permission = RolePermission::where([
                'role_id' => $data['role_id'],
                'permission_id' => $data['permission_id'],
                'permission_feature_id' => $value
            ])->first();
            if ($role_permission) {
                $role_permission->forceDelete();
            } else {
                DB::table('role_permissions')->insert([
                    'role_id' => $data['role_id'],
                    'permission_id' => $data['permission_id'],
                    'permission_feature_id' => $value
                ]);
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Permission Role update successfully'
        ], 201);
    }
}
