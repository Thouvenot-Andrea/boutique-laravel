<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Recommendation;
use Illuminate\Support\Str;


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

    public function create()
    {
        $categories = Category::all();
        return view('dashboard',compact('categories'));
    }
    public function store(Request $request):RedirectResponse
    {
       $request->validate([
           'picture'=>['required', 'file'],
           'name'=>['required', 'string', 'max:255'],
           'description'=>['required', 'string', 'max:800'],
           'weight'=>['required', 'string', 'max:5'],
           'stock'=>['required', 'string', 'max:10'],
           'HT_price'=>['required', 'string', 'max:10'],
           'VAT'=>['required', 'string', 'max:5'],
           'category_id'=>['required', 'select'],
           ]);

       $product = Product::create([
           'slug' => Str::of($request->name)->slug()->value(),
           'picture' => $request->picture,
           'name' => $request->name,
           'description' => $request->description,
           'weight' => $request->weight,
           'stock' => $request->stock,
           'HT_price' => $request->HT_price,
           'TTC_price' => $request->HT_price,
           'VAT' => $request->VAT,
           'category_id' => $request->category_id,
       ]);

              return redirect(RouteServiceProvider::HOME);
    }

}
