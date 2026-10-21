<?php
namespace App\Http\Controllers;
use App\Models\{Category, Product};
class ProductController extends Controller {
    public function index() {
        $products = Product::with('category')
            ->when(request('category'), fn($q, $slug) => $q->whereHas('category', fn($c) => $c->where('slug', $slug)))
            ->latest()->paginate(8)->withQueryString();
        return view('products.index', ['products' => $products, 'categories' => Category::all()]);
    }
    public function show(Product $product) {
        return view('products.show', compact('product'));
    }
}
