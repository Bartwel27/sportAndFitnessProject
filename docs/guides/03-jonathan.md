# Jonathan: Cart, checkout, orders

**Your files:** `CartController.php`, `cart/index.blade.php`, `cart/checkout.blade.php`, `Order.php`, `OrderItem.php`, the orders migration

## How it works
- The cart is stored in the **session** as an array: `[product_id => ['name','price','quantity']]`. Guests can shop without an account.
- `add()` reads the cart with `session('cart', [])`, adds the quantity (or creates the entry), saves with `session(['cart' => $cart])` and redirects back with a success message.
- `update()` changes a quantity (minimum 1) and `remove()` uses `unset($cart[$id])`.
- `total()` sums price × quantity with `collect($items)->sum(...)`.
- `/checkout` is inside the `auth` middleware, so a guest is sent to login first.
- `placeOrder()` first **validates** address, phone and payment (only `mobile_money` or `cod` allowed). Then `DB::transaction(...)` creates the order, creates one `order_items` row per cart item (copying name and price, so history stays correct if prices change later) and reduces stock with `decrement`. If anything fails, everything is rolled back. Finally the cart is cleared and the user goes to the dashboard.

## Be ready to answer
- *Why a transaction?* So we never get an order without items or stock reduced without an order.
- *Why copy name and price into order_items?* A later price change must not change old orders.
- *Why PATCH and DELETE on forms?* HTML forms only send GET/POST, so Blade's `@method('PATCH')` tells Laravel which one we mean.
- *What is a session?* Data stored on the server and linked to the visitor by a cookie.

## Demo
Add two products, change a quantity, remove one, log in, check out, show the order on the dashboard.
