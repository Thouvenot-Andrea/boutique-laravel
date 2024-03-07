<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use Illuminate\View\View;
use App\Models\Category;
use Nette\Utils\Paginator;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::inRandomOrder()->limit(4)->get();
        $comments = Comment::all();
        $categories = Category::all();

        foreach ($products as $product) {
            $product->comments = $comments->where('product_id', $product->id);
            $product->averageRating = $product->comments->avg('rating');

        }


        return view('homepage', compact('products', 'comments', 'categories'));
    }

}
