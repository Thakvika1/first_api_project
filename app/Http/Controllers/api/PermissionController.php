<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $data = Permission::all();
        return response()->json([
            'status' => 'success',
            'data' => $data,
        ], 200);
    }

    public function store(Request $r)
    {
        $data = Permission::create($r->all());
        return response()->json([
            'status' => 'success',
            'data' => $data,
        ], 201);
    }

    public function update(Request $r, $id)
    {
        $data = Permission::find($id);
        if (!$data) {
            return response()->json([
                'status' => 'error',
                'message' => 'Permission not found',
            ], 404);
        }

        $data->update($r->all());
        return response()->json([
            'status' => 'success',
            'data' => $data,
        ], 200);
    }

    public function destroy(Request $r, $id)
    {
        $data = Permission::find($id);
        if (!$data) {
            return response()->json([
                'status' => 'error',
                'message' => 'data not found',
            ], 404);
        }

        $data->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Permission deleted successfully',
        ], 200);
    }

    public function show(Request $r, $id)
    {
        $data = Permission::find($id);
        if (!$data) {
            return response()->json([
                'status' => 'error',
                'message' => 'Permission not found',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $data,
        ], 200);
    }
}
