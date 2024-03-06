<?php
namespace App\Http\Controllers;


use http\Env\Request;

use App\Models\Product;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all();
        return view('product-list');
    }

    public function get(Request $request)
    {
        return view('product-details', ['id' => $id]);
    }
}
