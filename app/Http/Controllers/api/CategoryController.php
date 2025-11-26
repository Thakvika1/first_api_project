<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class CategoryController extends Controller
{
    public function index(Request $r)
    {
        $categories = Category::with('users')->paginate($r->per_page ?? 10);

        return response()->json([
            'status' => 'success',
            'categories' => $categories,
        ], 200);
    }


    public function store(Request $r)
    {

        $category = Category::create([
            'name' => $r->name,
            'created_by' => Auth::id()
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Category created successfully',
            'category' => $category
        ], 201);
    }

    public function destroy(Request $r, $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json([
                'status' => 'error',
                'message' => 'Category not found',
            ], 404);
        }

        $category->deleted_by = Auth::id();
        $category->save();

        $category->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Category deleted successfully',
        ], 200);
    }

    public function show(Request $r, $id)
    {
        $users = User::with('categories')->find($id);
        if (!$users) {
            return response()->json([
                'staus' => 'error',
                'message' => 'user not found'
            ], 404);
        }

        if ($users->categories->isEmpty()) {
            return response()->json([
                'staus' => 'error',
                'message' => 'No categories found for this user'
            ], 404);
        }

        return response()->json([
            'staus' => 'success',
            'user' => $users,
        ], 200);
    }

    public function update(Request $r, $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'status' => 'error',
                'message' => 'Category not found'
            ]);
        }

        $validator = Validator::make($r->all(), [
            'name' => 'sometimes|required|string|max:50'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ]);
        }

        $category->updated_by = Auth::id();
        $category->save();
        $category->update($validator->validated());

        return response()->json([
            'staus' => 'success',
            'category' => $category,
        ]);
    }
}
