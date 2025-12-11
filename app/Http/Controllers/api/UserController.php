<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\BaseCrudController;

class UserController extends BaseCrudController
{

    public function __construct()
    {
        $this->model = User::class;
        $this->validateCreateData = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:100',
            'password' => 'required|string|min:8',
            'role_id' => 'nullable|exists:roles,id',
        ];
        $this->validateUpdateData = [
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:users,email,{id}|max:100',
            'password' => 'sometimes|required|string|min:8',
            'role_id' => 'nullable|exists:roles,id',
        ];
    }
}
