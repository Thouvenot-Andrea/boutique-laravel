<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Providers\RouteServiceProvider;
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


    public function index(Request $request)
    {
        // Créer une instance de la requête pour les produits
        $productsQuery = Product::query();

        // Appliquer les filtres
        $productsQuery = $this->priceFilter($request, $productsQuery);
        $productsQuery = $this->stockFilter($request, $productsQuery);
        $productsQuery = $this->ratingFilter($request, $productsQuery);

        // Paginer les résultats
        $products = $productsQuery->paginate(6);

        // Récupérer les commentaires une fois que les filtres sont appliqués
        $comments = Comment::all();

        // Appliquer les filtres après la pagination
        $products->each(function ($product) use ($comments) {
            $product->comments = $comments->where('product_id', $product->id);
            $product->averageRating = $product->comments->avg('rating');
        });

        return view('products', compact('products'));
    }

    private function priceFilter(Request $request, $productsQuery)
    {
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');

        // Appliquer les filtres
        if ($minPrice) {
            $productsQuery = $productsQuery->where('TTC_price', '>=', (float)$minPrice);
        }

        if ($maxPrice) {
            $productsQuery = $productsQuery->where('TTC_price', '<=', (float)$maxPrice);
        }

        return $productsQuery;
    }

    private function stockFilter(Request $request, $productsQuery)
    {
        if ($request->filled('in_stock')) {
            $inStock = $request->input('in_stock') == 'true';

            // Appliquer le filtre de stock
            if ($inStock) {
                $productsQuery = $productsQuery->where('stock', '>', 0);
            }
        }

        return $productsQuery;
    }

    private function ratingFilter(Request $request, $productsQuery)
    {
        if ($request->has('min_rating')) {
            $minRating = (float)$request->input('min_rating');

            // Appliquer le filtre de note minimale
            $productsQuery = $productsQuery->whereHas('comments', function ($query) use ($minRating) {
                $query->where('rating', '>=', $minRating);
            });
        }

        return $productsQuery;
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
