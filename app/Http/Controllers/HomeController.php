<?php
namespace App\Http\Controllers;
use App\Models\Category;
use Nette\Utils\Paginator;

class HomeController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view('homepage', compact('categories'));
    }

}
