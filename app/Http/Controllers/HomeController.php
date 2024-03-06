<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Nette\Utils\Paginator;

class HomeController extends Controller
{
    public function index()
    {
        return view('homepage', ['categories' => Category::all()]);
    }

}
