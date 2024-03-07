<?php
namespace App\Http\Controllers;

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
        $recommendations = $product->recommendations->random(3);
        return view('product-details', ['id' => $id], compact('product', 'recommendations'));
    }
}
