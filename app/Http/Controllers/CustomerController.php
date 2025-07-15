<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function store(Request $request)
    {
        Customer::create($request->all());

        return response()->json(['status' => 'success', 'message' => 'Customer added successfully']);
    }

    public function showOrders(Customer $customer)
    {
        return OrderResource::collection($customer->orders);
    }
}
