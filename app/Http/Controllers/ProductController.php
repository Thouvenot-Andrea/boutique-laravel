<?php
namespace App\Http\Controllers;

class ProductController extends Controller
{
    public function index(){
        return view('product-list');
    }

    public function get($id)
    {
        return view('product-details', ['id' => $id]);
    }
}
