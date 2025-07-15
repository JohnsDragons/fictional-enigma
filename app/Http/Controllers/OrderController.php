<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request) {
        $order = Order::create($request->all());

        return new OrderResource($order);
    }

    public function addProduct(Order $order, Request $request) {
        $product = Product::findOrFail($request->get('product_id'));

        $order->products()->save($product, ['quantity' => $request->get('quantity')]);

        return new OrderResource($order);
    }

    public function show(Order $order)
    {
        return new OrderResource($order);
    }
}
