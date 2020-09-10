<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
        $products = Product::with(['galleries'])->latest()->paginate(32);

        return view('pages.category', [
            'categories' => $categories,
            'products' => $products
        ]);
    }

    public function detail(Request $request, $slug)
    {
        $categories = Category::latest()->get();
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = Product::with(['galleries'])->where('category_id', $category->id)->latest()->paginate(32);

        return view('pages.category', [
            'categories' => $categories,
            'products' => $products
        ]);
    }
}
