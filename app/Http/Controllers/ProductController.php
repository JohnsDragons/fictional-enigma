<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function store(Request $request) {
        Product::create($request->all());

        return response()->json(['status' => 'success', 'message' => 'Product added successfully']);
    }
}
