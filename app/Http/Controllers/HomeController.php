<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::take(6)->latest()->get();
        $products = Product::with(['galleries'])->take(8)->latest()->get();

        return view('pages.home', [
            'categories' => $categories,
            'products' => $products
        ]);
    }
}
