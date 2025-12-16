<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $data = Order::with('customers', 'orderDetails')->paginate($request->per_page ?? 10);

        return response()->json([
            'status' => 'success',
            'data' => $data
        ], 200);
    }

    public function order(Request $request)
    {
        // {
        //     "items" : [
        //         {"product_id":1, "price":5, "qty": 2}
        //     ],
        //     "discount" : 1,
        //     "customer_id" : 1
        // }

        $validator = Validator::make($request->all(), [
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.price' => 'required|numeric|min:0',
            'items.*.qty' => 'required|integer|min:1',
            'discount' => 'nullable|numeric|min:0',
            'customer_id' => 'required|exists:customers,id,deleted_at,NULL',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 400);
        }

        $data = $validator->validated();
        // dd($data);

        DB::beginTransaction();
        try {
            $total = 0;

            foreach ($data['items'] as $key => $item) {
                $product_exist = Product::find($item['product_id']);
                // check product exist
                if (!$product_exist) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Product with ID ' . $item['product_id'] . ' does not exist.'
                    ], 400);
                }
                // check stock qty
                if ($product_exist->qty < $item['qty']) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Insufficient stock for product ID ' . $item['product_id'] . '. Available quantity: ' . $product_exist->qty
                    ], 400);
                }
                // check price
                if ($product_exist->price != $item['price']) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Price mismatch for product ID ' . $item['product_id'] . '. Current price: ' . $product_exist->price
                    ], 400);
                }

                // calculate total
                $total += $item['price'] * $item['qty'];
            }

            $grand_total = $total - $data['discount'] ?? 0;

            $order = new Order();
            $order->customer_id = $data['customer_id'];
            $order->total_amount = $total;
            $order->discount = $data['discount'] ?? 0;
            $order->grand_total = $grand_total;
            $order->save();

            // insert order details
            foreach ($data['items'] as $key => $item) {
                $order_detail = new OrderDetail();
                $order_detail->order_id = $order->id;
                $order_detail->product_id = $item['product_id'];
                $order_detail->price = $item['price'];
                $order_detail->qty = $item['qty'];
                $order_detail->total = $item['price'] * $item['qty'];
                $order_detail->save();

                // reduce product qty
                $product_exist = Product::find($item['product_id']);
                $product_exist->qty -= $item['qty'];
                $product_exist->save();
            }
            DB::commit();

            return response()->json([
                'status' => 'success',
                // 'data' => $order->load('customers', 'orderDetails')
                'data' => $order,
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Order creation failed: ' . $e->getMessage()
            ], 500);
        }
    }
}
