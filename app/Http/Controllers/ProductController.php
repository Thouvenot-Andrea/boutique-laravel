<?php
namespace App\Http\Controllers;

use http\Env\Request;

class ProductController extends Controller
{
    public function index(){
        return view('product-list');
    }

    public function get(Request $request)
    {
        return view('product-details', ['id' => $id]);
    }
}
