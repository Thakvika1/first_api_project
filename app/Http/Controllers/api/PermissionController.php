<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permission;
use App\Http\Controllers\BaseCrudController;

class PermissionController extends BaseCrudController
{
    public function __construct()
    {
        $this->model = Permission::class;

        $this->validateCreateData = [
            'name' => 'required|string|unique:permissions,name|max:100',
            'key' => 'required|string|unique:permissions,key|max:100',
            'description' => 'nullable|string|max:255',
        ];

        $this->validateUpdateData = [
            'name' => 'sometimes|required|string|unique:permissions,name,{id}|max:100',
            'key' => 'sometimes|required|string|unique:permissions,key,{id}|max:100',
            'description' => 'nullable|string|max:255',
        ];
    }
}
