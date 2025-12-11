<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Controllers\BaseCrudController;

class CategoryController extends BaseCrudController
{

    public function __construct()
    {
        $this->model = Category::class;

        $this->validateCreateData = [
            'name' => 'required|string|max:255',
        ];

        $this->validateUpdateData = [
            'name' => 'sometimes|required|string|max:255',
        ];
    }
}
