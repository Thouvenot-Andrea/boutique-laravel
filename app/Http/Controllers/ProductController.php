<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

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


    public function get($id)
    {
        return view('product-details', ['id' => $id]);
    }
}
