# Thelma: Products (list, details, filter, images)

**Your files:** `ProductController.php`, `products/index.blade.php`, `products/show.blade.php`

## How it works
- URL `/products` runs `ProductController@index`. It builds a query: `Product::with('category')`, then `->when(request('category'), ...)` adds a filter only if `?category=football` is in the URL. The filter uses `whereHas('category', ...)` to match the category's slug.
- `->paginate(8)` returns 8 products per page and `->withQueryString()` keeps the filter when you click page 2. `{{ $products->links() }}` draws the page buttons.
- `/products/{product}` uses **route model binding**: Laravel sees `{product}` and the `Product $product` argument, and fetches that product automatically (404 if it doesn't exist).
- Images: `asset('storage/'.$p->image)` builds the public URL. It works because `php artisan storage:link` links `public/storage` to `storage/app/public`. If a product has no image, the page shows a grey placeholder.
- The "Add to cart" button is a small form that POSTs to `/cart/add/{id}`.

## Be ready to answer
- *Why `@forelse`?* It is a loop with a built-in "empty" message.
- *What is eager loading?* `with('category')` avoids the N+1 problem (one extra query per product).
- *GET vs POST?* GET reads data (list, details); POST changes data (add to cart).

## Demo
Open `/products`, choose Gym from the dropdown, open a product, add it to the cart.
