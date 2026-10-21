<?php
namespace App\Http\Controllers;
use App\Models\{Order, Product};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class CartController extends Controller {
    private function total(array $items): float {
        return collect($items)->sum(fn($i) => $i['price'] * $i['quantity']);
    }
    public function index() {
        $items = session('cart', []);
        return view('cart.index', ['items' => $items, 'total' => $this->total($items)]);
    }
    public function add(Request $request, Product $product) {
        $qty = max(1, (int) $request->input('quantity', 1));
        $cart = session('cart', []);
        if (isset($cart[$product->id])) { $cart[$product->id]['quantity'] += $qty; }
        else { $cart[$product->id] = ['name' => $product->name, 'price' => $product->price, 'quantity' => $qty]; }
        session(['cart' => $cart]);
        return back()->with('success', $product->name . ' added to cart.');
    }
    public function update(Request $request, $id) {
        $cart = session('cart', []);
        if (isset($cart[$id])) { $cart[$id]['quantity'] = max(1, (int) $request->quantity); session(['cart' => $cart]); }
        return back();
    }
    public function remove($id) {
        $cart = session('cart', []);
        unset($cart[$id]);
        session(['cart' => $cart]);
        return back()->with('success', 'Item removed.');
    }
    public function checkout() {
        $items = session('cart', []);
        if (empty($items)) { return redirect('/cart'); }
        return view('cart.checkout', ['items' => $items, 'total' => $this->total($items)]);
    }
    public function placeOrder(Request $request) {
        $data = $request->validate(['address' => 'required|string', 'phone' => 'required|string', 'payment' => 'required|in:mobile_money,cod']);
        $items = session('cart', []);
        if (empty($items)) { return redirect('/cart'); }
        DB::transaction(function () use ($data, $items) {
            $order = Order::create($data + ['user_id' => auth()->id(), 'total' => $this->total($items)]);
            foreach ($items as $id => $i) {
                $order->items()->create(['product_id' => $id, 'name' => $i['name'], 'price' => $i['price'], 'quantity' => $i['quantity']]);
                Product::where('id', $id)->decrement('stock', $i['quantity']);
            }
        });
        session()->forget('cart');
        return redirect('/dashboard')->with('success', 'Order placed. Thank you!');
    }
}
