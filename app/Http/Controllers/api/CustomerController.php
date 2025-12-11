<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\BaseCrudController;

class CustomerController extends BaseCrudController
{
    public function __construct()
    {
        $this->model = Customer::class;

        $this->validateCreateData = [
            'name' => 'required|string|max:255',
        ];

        $this->validateUpdateData = [
            'name' => 'sometimes|required|string|max:255',
        ];
    }
}
