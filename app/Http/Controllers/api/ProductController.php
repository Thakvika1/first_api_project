<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $r)
    {

        //     try {
        //         return response()->json([
        //             'status' => 'success',
        //             'from' => Auth()->user(),
        //             'data' => [
        //                 (object)[ 
        //                     'id' => 1,
        //                     'name' => 'Product 1',
        //                     'price' => 100
        //                 ],
        //                 (object)[
        //                     'id' => 2,
        //                     'name' => 'Product 2',
        //                     'price' => 200
        //                 ],
        //             ]
        //         ], 200);
        //     } catch (\Exception $e) {
        //         return response()->json([
        //             'status' => 'error',
        //             'message' => $e->getMessage()
        //         ], 200);
        //     }
    }
}
