<?php

namespace App\Http\Controllers;


use http\Env\Request;

use App\Models\Product;
use App\Models\Recommendation;

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

        if ($product && $product->recommendations->count() > 0) {
            $recommendations = $product->recommendations->random(min(3, $product->recommendations->count()));
        } else {
            $recommendations = [];
        }
        return view('product-details', ['id' => $id, 'product' => $product, 'recommendations' => $recommendations]);
    }

    public function getBySlug($slug)
    {
        $product = Product::where('slug', $slug)->first();
        if ($product && $product->recommendations->count() > 0) {
            $recommendations = $product->recommendations->random(min(3, $product->recommendations->count()));
        } else {
            $recommendations = [];
        }
        return view('product-details', ['id' => $product->id, 'product' => $product, 'recommendations' => $recommendations]);
    }
}
