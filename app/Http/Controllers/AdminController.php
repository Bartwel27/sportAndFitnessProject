<?php
namespace App\Http\Controllers;
use App\Models\{Category, Order, Product, User};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class AdminController extends Controller {
    // ---- Overview ----
   public function dashboard()
{
    $stats = [
        'products'   => Product::count(),
        'categories' => Category::count(),
        'orders'     => Order::count(),
        'pending'    => Order::where('status', 'pending')->count(),
        'users'      => User::where('role', 'customer')->count(),
        'revenue'    => Order::whereNotIn('status', ['rejected'])->sum('total'),
    ];
    $latest   = Order::with('user')->latest()->take(5)->get();
    $lowStock = Product::with('category')->where('stock', '<=', 5)->orderBy('stock')->take(5)->get();
    $newUsers = User::where('role', 'customer')->latest()->take(5)->get();
    return view('admin.dashboard', compact('stats', 'latest', 'lowStock', 'newUsers'));
}

    // ---- Products ----
    private function productRules(): array {
        return [
            'name' => 'required|string', 'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0', 'stock' => 'required|integer|min:0',
            'description' => 'nullable|string', 'image' => 'nullable|image|max:2048',
        ];
    }
    public function products() {
        return view('admin.products', ['products' => Product::with('category')->latest()->get(), 'categories' => Category::all()]);
    }
    public function storeProduct(Request $request) {
        $data = $request->validate($this->productRules());
        if ($request->hasFile('image')) { $data['image'] = $request->file('image')->store('products', 'public'); }
        Product::create($data);
        return back()->with('success', 'Product added.');
    }
    public function editProduct(Product $product) {
        return view('admin.product-edit', ['product' => $product, 'categories' => Category::all()]);
    }
    public function updateProduct(Request $request, Product $product) {
        $data = $request->validate($this->productRules());
        if ($request->hasFile('image')) {
            if ($product->image) { Storage::disk('public')->delete($product->image); }
            $data['image'] = $request->file('image')->store('products', 'public');
        }
        $product->update($data);
        return redirect('/admin/products')->with('success', 'Product updated.');
    }
    public function deleteProduct(Product $product) {
        if ($product->image) { Storage::disk('public')->delete($product->image); }
        $product->delete();
        return back()->with('success', 'Product deleted.');
    }

    // ---- Categories ----
    public function categories() {
        return view('admin.categories', ['categories' => Category::withCount('products')->get()]);
    }
    public function storeCategory(Request $request) {
        $data = $request->validate(['name' => 'required|string|unique:categories,name']);
        Category::create(['name' => $data['name'], 'slug' => Str::slug($data['name'])]);
        return back()->with('success', 'Category added.');
    }
    public function deleteCategory(Category $category) {
        if ($category->products()->exists()) {
            return back()->with('success', 'Cannot delete: this category still has products.');
        }
        $category->delete();
        return back()->with('success', 'Category deleted.');
    }

    // ---- Orders ----
    public function orders() {
        return view('admin.orders', ['orders' => Order::with('user')->latest()->paginate(10)]);
    }
    public function updateOrder(Request $request, Order $order) {
        $order->update($request->validate(['status' => 'required|in:pending,paid,shipped,delivered']));
        return back()->with('success', 'Order status updated.');
    }

    // ---- Users ----
    public function users() {
        return view('admin.users', ['users' => User::withCount('orders')->latest()->paginate(15)]);
    }
}
