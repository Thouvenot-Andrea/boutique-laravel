<?php

namespace App\Http\Controllers;


use App\Http\Requests\ProductRequest;
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

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Nette\Utils\Image;

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
//        $this->authorize('create', Product::class);

        $categories = Category::all();
        return view('dashboard', compact('categories'));
    }

    /**
     * @throws AuthorizationException
     */
    public function store(Request $request): RedirectResponse
    {
//        $this->authorize('create', Product::class);
        $request->validate([

            'picture' => ['required', 'string'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:800'],
            'weight' => ['required', 'string', 'max:5'],
            'stock' => ['required', 'string', 'max:10'],
            'HT_price' => ['required', 'string', 'max:10'],
            'VAT' => ['required', 'string', 'max:5'],
            'category_id' => ['required', 'string'],
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

    public function edit($product)
    {
        $categories = Category::all();
        $product = Product::where('slug', $product)->first();
        return view('product-edit', ['product' => $product], compact('categories','product'));
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $validateData = $request->validate([

            'picture' => ['required', 'string'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:800'],
            'weight' => ['required', 'string', 'max:5'],
            'stock' => ['required', 'string', 'max:10'],
            'HT_price' => ['required', 'string', 'max:10'],
            'VAT' => ['required', 'string', 'max:5'],
            'category_id' => ['required', 'string'],
        ]);

        $product->update($validateData);
        return Redirect::route('products.edit',['product' => $product->slug])->with('success', 'Le produit à été modifié avec succès');

    }
}
