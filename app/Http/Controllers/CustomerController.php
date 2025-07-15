<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Http\Resources\OrderResource;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function store(CustomerRequest $request)
    {
        Customer::create($request->all());

        return response()->json(['status' => 'success', 'message' => 'Customer added successfully']);
    }

    public function showOrders(Customer $customer)
    {
        return OrderResource::collection($customer->orders);
    }
}
