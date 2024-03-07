<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use http\Env\Request;
use App\Models\Product;
use App\Models\Recommendation;

class ProductController extends Controller
{
    public function index(){
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
        $comments = $product->comments;
        $averageRating = $comments->avg('rating');
        return view('product-details', ['id' => $id], compact('comments', 'product', 'averageRating','recommendations'));
    }
}
