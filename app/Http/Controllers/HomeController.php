<?php

namespace App\Http\Controllers;


use App\Models\Comment;
use App\Models\Product;
use Illuminate\View\View;
use App\Models\Category;
use Nette\Utils\Paginator;

class HomeController extends Controller
{

    public function index()
    {

        return view('homepage', [
//            'products' => Product::inRandomOrder()->limit(4)->get(),
            'comments' => Comment::get(['rating']),
//            'categories'=> Category::all(),

           'products' => Product::inRandomOrder()->paginate(2),
            ]);
    }



//    public function index(){
//        $categories = Category::all();
//        return view('homepage', compact('categories'),
//        );
//    }


}
