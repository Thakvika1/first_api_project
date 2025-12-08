<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use App\Models\PermissionFeature;
use App\Models\RolePermission;

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

        
        //

    }
}
