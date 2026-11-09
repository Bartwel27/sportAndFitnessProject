<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')->get();
        $latest = Product::with('category')->latest()->take(8)->get();

        $sections = $categories->take(3)->map(fn ($c) => [
            'category' => $c,
            'products' => $c->products()->with('category')->latest()->take(4)->get(),
        ])->filter(fn ($s) => $s['products']->isNotEmpty());

        return view('landing', compact('categories', 'latest', 'sections'));
    }
}
