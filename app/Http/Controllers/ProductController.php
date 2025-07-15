<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;

class ProductController extends Controller
{
    public function store(ProductRequest $request) {
        Product::create($request->all());

        return response()->json(['status' => 'success', 'message' => 'Product added successfully']);
    }
}
