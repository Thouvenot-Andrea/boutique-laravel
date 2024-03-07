<?php

namespace App\Http\Controllers;


use http\Env\Request;

use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('product-list');
    }

    public function get($id)
    {
        $product = Product::find($id);
        return view('product-details', compact('product'));
    }
}
