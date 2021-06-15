<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function placeOrder($products){
        $user = request()->user('sanctum');

        $products = collect($products);
        $products = $products->unique('id');

        $products = $this->calculateProducts($products);
        list($total, $subtotal, $discount) = $this->calculateOrder($products);

        $order = new Order();
        $order->user_id = ($user) ? $user->id : null;
        $order->total = $total;
        $order->subtotal = $subtotal;
        $order->discount = ($user) ? $discount : 0.00;
        $order->save();

        foreach ($products as $product){
            $order->Items()->create($product);
        }


        return $order->id;
    }

    private function calculateOrder($products){

        $price = $products->sum('price');
        $discount = $products->sum('discount');
        return [$price + $discount, $price, $discount];

    }

    private function calculateProducts($products_collection){
        $user = request()->user('sanctum');
        $discount_percent = 0;

        if ($user){
            $discount_percent = $user->Discounts()
                                ->where('active', true)
                                ->first()
                                ->Discount
                                ->value('discount_percent');
        }

        $ids = $products_collection->implode(['id'], ',');
        $products = Product::findMany(explode(',',$ids));
        $stored_items = [];

        foreach ($products_collection as $key => $product_collection){
            $amount = $product_collection['amount'];
            $product = $products[$key];

            $id = $product->id;
            $price = $product->price * $amount;

            $discount = 0;
            if ($discount_percent > 0){
                $discount = ($price / 100) * $discount_percent;
            }

            array_push($stored_items, [
                'product_id' => $id,
                'price' => $price - $discount,
                'discount' => $discount,
                'amount' => $amount,
            ]);

        }

        return collect($stored_items);
    }
}
