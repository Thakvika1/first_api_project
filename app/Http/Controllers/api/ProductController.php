<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Controllers\BaseCrudController;

// class ProductController extends Controller
// {
//     //
// }

class ProductController extends BaseCrudController
{
    public function __construct(Product $model)
    {
        $this->model = $model;
        $this->validateCreateData = [
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'qty' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|url',
        ];
        $this->validateUpdateData = [
            'category_id' => 'sometimes|required|exists:categories,id',
            'name' => 'sometimes|required|string|max:255',
            'price' => 'sometimes|required|numeric|min:0',
            'qty' => 'sometimes|required|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|url',
        ];
    }
}
