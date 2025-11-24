<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(Request $r)
    {

        $users = User::paginate($r->per_page ?? 10);
        return response()->json([
            'status' => 'success',
            'users' => $users,
        ], 200);
    }

    public function get(Request $r, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found',
            ], 404);
        }
        return response()->json([
            'status' => 'success',
            'user' => $user,
        ], 200);
    }

    public function store(Request $r)
    {
        $validator = Validator::make($r->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:100',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'validated error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = User::create($validator->validated());
        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => $user,

        ], 201);
    }

    public function update(Request $r, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found',
            ], 404);
        }

        $validator = Validator::make($r->all(), [
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:users,email,' . $id . '|max:100',
            'password' => 'sometimes|required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'validated error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $user->update($validator->validated());
        return response()->json([
            'status' => 'success',
            'message' => 'User updated successfully',
            'user' => $user,
        ], 200);
    }

    public function destroy(Request $r, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found',
            ], 404);
        };
        $user->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'User deleted successfully',
        ], 200);
    }
}
