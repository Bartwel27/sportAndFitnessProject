<?php
namespace App\Http\Controllers;
use App\Models\{Category, Order, Product, User};
class ProductController extends Controller {
    private function query() {
        return Product::with('category')
            ->when(request('category'), fn($q, $slug) => $q->whereHas('category', fn($c) => $c->where('slug', $slug)))
            ->when(request('q'), fn($q, $term) => $q->where('name', 'like', '%' . $term . '%'))
            ->latest();
    }
    public function index() {
        $products = $this->query()->paginate(8)->withQueryString();
        return view('products.index', ['products' => $products, 'categories' => Category::all()]);
    }
    public function show(Product $product) {
        return view('products.show', compact('product'));
    }
    // Polled by public/js/live.js every 5 seconds. Returns a short fingerprint of the data the
    // current visitor can see. When the fingerprint changes, the page refreshes its live blocks.
    public function version() {
        $sig = [
            Product::count(), Product::max('updated_at'), Product::sum('stock'), Product::sum('id'),
            Category::count(), Category::max('updated_at'),
        ];
        if (auth()->check()) {
            $isAdmin = auth()->user()->role === 'admin';
            $orders = $isAdmin ? Order::query() : Order::where('user_id', auth()->id());
            $sig[] = $orders->count();
            $sig[] = $orders->max('updated_at');
            if ($isAdmin) { $sig[] = User::count(); }
        }
        return response()->json(['v' => md5(json_encode($sig))])->header('Cache-Control', 'no-store');
    }
}
