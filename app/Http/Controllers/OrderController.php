<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddProductToOrderRequest;
use App\Http\Requests\CreateOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\Product;

class OrderController extends Controller
{
    public function store(CreateOrderRequest $request) {
        $order = Order::create($request->all());

        return new OrderResource($order);
    }

    public function addProduct(Order $order, AddProductToOrderRequest $request) {
        $product = Product::findOrFail($request->get('product_id'));

        $order->products()->save($product, ['quantity' => $request->get('quantity')]);

        return new OrderResource($order);
    }

    public function show(Order $order)
    {
        return new OrderResource($order);
    }
}
