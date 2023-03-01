<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    public function store(Request $request)
    {
        $product = Product::create($request->post());
        return response()->json([
            'message'=>'Product Created Successfully!!',
            'product'=>$product
        ]);
    }

    public function show(Product $product)
    {
        return response()->json($product);
    }

    public function update(Request $request, Product $product)
    {
        $product->fill($request->post())->save();
        return response()->json([
            'message'=>'Product Updated Successfully!!',
            'product'=>$product
        ]);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json([
            'message'=>'Product Deleted Successfully!!'
        ]);
    }
}