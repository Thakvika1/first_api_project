<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PermissionFeature;
use App\Http\Controllers\BaseCrudController;

class PermissionFeatureController extends BaseCrudController
{

    public function __construct()
    {
        $this->model = PermissionFeature::class;

        $this->validateCreateData = [
            'permission_id' => 'required|exists:permissions,id',
            'name' => 'required|string|max:255',
            'key' => 'required|string|max:255|',
            'description' => 'nullable|string',
        ];

        $this->validateUpdateData = [
            'permission_id' => 'sometimes|required|exists:permissions,id',
            'name' => 'sometimes|required|string|max:255',
            'key' => 'sometimes|required|string|max:255|',
            'description' => 'nullable|string',
        ];
    }
}

// class PermissionFeatureController extends Controller
// {
//     public function index()
//     {
//         $data = PermissionFeature::all();
//         return response()->json([
//             'status' => 'success',
//             'data' => $data,
//         ], 200);
//     }

//     public function store(Request $r)
//     {
//         $data = PermissionFeature::create($r->all());
//         return response()->json([
//             'status' => 'success',
//             'data' => $data,
//         ], 201);
//     }

//     public function update(Request $r, $id)
//     {
//         $data = PermissionFeature::find($id);
//         if (!$data) {
//             return response()->json([
//                 'status' => 'error',
//                 'message' => 'Permission Feature not found',
//             ], 404);
//         }

//         $data->update($r->all());
//         return response()->json([
//             'status' => 'success',
//             'data' => $data,
//         ], 200);
//     }

//     public function destroy(Request $r, $id)
//     {
//         $data = PermissionFeature::find($id);
//         if (!$data) {
//             return response()->json([
//                 'status' => 'error',
//                 'message' => 'data not found',
//             ], 404);
//         }

//         $data->delete();
//         return response()->json([
//             'status' => 'success',
//             'message' => 'Permission Feature deleted successfully',
//         ], 200);
//     }

//     public function show(Request $r, $id)
//     {
//         $data = PermissionFeature::find($id);
//         if (!$data) {
//             return response()->json([
//                 'status' => 'error',
//                 'message' => 'Permission Feature not found',
//             ], 404);
//         }

//         return response()->json([
//             'status' => 'success',
//             'data' => $data,
//         ], 200);
//     }
// }
