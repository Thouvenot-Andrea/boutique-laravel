<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{

    public function index()
    {
        $products = Auth::user()->wishlist?->products;
        if(!$products)
        {
            return view('wishlist', ['products' => collect()]);
        }
        return view('wishlist', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        if(!isset($request->user()->wishlist))
        {
            $request->user()->wishlist()->save(Wishlist::create([
                'user_id' => $request->user()->id
            ]));
        }

        $request->user()->wishlist->products()->attach($request->product_id);

        return back();
    }

    public function destroy(Request $request)
    {

        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);
        $request->user()->wishlist->products()->detach($request->product_id);

        return back();
    }

    public function clear(Request $request)
    {
        $request->user()->wishlist->products()->detach();

        return back();
    }

    public function move(Request $request, $id)
    {
        $request->user()->wishlist()->detach($id);
        $request->user()->cart()->attach($id);

        return back();
    }

    public function moveAll(Request $request)
    {
        $request->user()->cart()->attach($request->user()->wishlist->pluck('id'));
        $request->user()->wishlist()->detach();

        return back();
    }

    public function update(Request $request, $id)
    {
        $request->user()->wishlist()->updateExistingPivot($id, [
            'quantity' => $request->quantity
        ]);

        return back();
    }

    public function add(Request $request, $id)
    {
        $request->user()->wishlist()->updateExistingPivot($id, [
            'quantity' => $request->user()->wishlist->where('id', $id)->first()->pivot->quantity + 1
        ]);

        return back();
    }

    public function remove(Request $request, $id)
    {
        $request->user()->wishlist()->updateExistingPivot($id, [
            'quantity' => $request->user()->wishlist->where('id', $id)->first()->pivot->quantity - 1
        ]);

        return back();
    }

    public function moveAllToCart(Request $request)
    {
        $request->user()->cart()->attach($request->user()->wishlist->pluck('id'));
        $request->user()->wishlist()->detach();

        return back();
    }

    public function moveToCart(Request $request, $id)
    {
        $request->user()->wishlist()->detach($id);
        $request->user()->cart()->attach($id);
    }
}
