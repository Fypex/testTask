<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    private $message = 'Thank you for the order. Your order #{order_id} has been sent for processing';


    public function getProducts(){
        return response()->json(Product::all(), 200);
    }

    public function order(Request $request){

        $validator = Validator::make($request->all(), [
            'products' => 'required|array|min:1',
            'products.*.id' => 'required|integer|min:1|exists:products',
            'products.*.amount' => 'required|integer|min:1',
        ]);

        if ($validator->fails()){
            return response($validator->errors()->first(), 400);
        }

        $order = new OrderController();
        $order_id = $order->placeOrder($request->products);

        return response()->json($this->successMessage($order_id), 200);

    }

    private function successMessage($order_id){
        return str_replace('{order_id}', $order_id, $this->message);
    }
}
