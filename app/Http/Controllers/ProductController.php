<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Providers\RouteServiceProvider;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Recommendation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request, string $category_id)
    {
        $category = Category::where('slug', '=', $category_id)->first();
        $products = $category->products();

        $products = $this->priceFilter($request, $products);
        $products = $this->ratingFilter($request, $products);

        $products = $products->paginate(6);

        $products->each(function ($product) {
            $product->averageRating=$product->comments->avg('rating');
        });
        return view('products', compact('products', 'category'));
    }

    private function priceFilter(Request $request, $products)
    {
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');

        if ($minPrice) {
            $products = $products->where('TTC_price', '>=', (int)$minPrice);
        }
        if ($maxPrice) {
            $products = $products->where('TTC_price', '<=', (int)$maxPrice);
        }
        return $products;
    }

    private function ratingFilter(Request $request, HasMany $products)
    {
        if ($request->has('min_rating')) {
            $minRating = (float)$request->input('min_rating');

            $products = $products->whereHas('comments', function ($query) use ($minRating) {
                $query->selectRaw('product_id, AVG(rating) as average_rating')
                    ->groupBy('product_id')
                    ->havingRaw('AVG(rating) >= ?', [$minRating]);
            });
        }

        return $products;
    }
    private function average($products, $comments)
    {
        foreach ($products as $product) {
            $product->comments = $comments->where('product_id', $product->id);
            $product->averageRating = $product->comments->avg('rating');
        }
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $products = [];
        if ($search) {
            $products = Product::
                where('name', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%')->get();
        }
        return view('searchResult', compact(
            'products',
            'search',
        ));
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
        $this->authorize('create', Product::class);

        $categories = Category::all();
        return view('dashboard', compact('categories'));
    }

    /**
     * @throws AuthorizationException
     */
    public function store(Request $request): RedirectResponse
    {
        $this->authorize('create', Product::class);
        $request->validate([
            'picture' => ['required', 'file'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:800'],
            'weight' => ['required', 'string', 'max:5'],
            'stock' => ['required', 'string', 'max:10'],
            'HT_price' => ['required', 'string', 'max:10'],
            'VAT' => ['required', 'string', 'max:5'],
            'category_id' => ['required', 'select'],
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
