<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    //
    public function index()
    {
        $data = Role::all();
        return response()->json([
            'status' => 'success',
            'roles' => $data,
        ], 200);
    }

    public function store(Request $r)
    {
        $data = Role::create($r->all());
        return response()->json([
            'status' => 'success',
            'role' => $data,
        ], 201);
    }

    public function update(Request $r, $id)
    {
        $data = Role::find($id);
        if (!$data) {
            return response()->json([
                'status' => 'error',
                'message' => 'Role not found',
            ], 404);
        }

        $data->update($r->all());
        return response()->json([
            'status' => 'success',
            'role' => $data,
        ], 200);
    }

    public function destroy(Request $r, $id)
    {
        $data = Role::find($id);
        if (!$data) {
            return response()->json([
                'status' => 'error',
                'message' => 'Role not found',
            ], 404);
        }

        $data->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Role deleted successfully',
        ], 200);
    }

    public function show(Request $r, $id)
    {
        $data = Role::find($id);
        if (!$data) {
            return response()->json([
                'status' => 'error',
                'message' => 'Role not found',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'role' => $data,
        ], 200);
    }
}
