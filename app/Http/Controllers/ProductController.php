<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Recommendation;


class ProductController extends Controller
{
    public function index()
    {

        $products = Product::all();
        return view('product-list');
    }


    public function search(Request $request)
    {

        $search = $request->input('search');

        $products = Product::latest();

        if ($search) {
            $products
                ->where('name', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%');

        }
        $search = $products->get();

        return view('searchResult', [
            'products' => $search,
            'searchTerm' => $search,

        ]);

    }

    public function getBySlug($slug)

    {
        $product = Product::where('slug', $slug)->first();
        if ($product && $product->recommendations->count() > 0) {
            $recommendations = $product->recommendations->random(min(3, $product->recommendations->count()));
        } else {
            $recommendations = [];
        }
        $comments = $product->comments;
        $averageRating = $comments->avg('rating');
        return view('product-details', ['id' => $slug], compact('comments', 'product', 'averageRating', 'recommendations'));
    }
}
