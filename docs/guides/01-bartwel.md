# Bartwel: Setup, database, landing page, integration

**Your files:** `database/migrations/*`, `app/Models/*`, `database/seeders/DatabaseSeeder.php`, `HomeController.php`, `landing.blade.php`, `routes/web.php`

## How it works
- A **migration** is a PHP file that creates or changes a table. `php artisan migrate` runs them in date order. `up()` creates, `down()` undoes.
- A **model** is a PHP class for one table. `Product` represents `products`. `$fillable` lists the columns that are allowed to be filled in bulk (this protects against mass-assignment attacks). Relationships like `hasMany` and `belongsTo` let you write `$product->category->name`.
- The **seeder** inserts starter data: the admin user (role `admin`, password hashed), 4 categories and 8 products. `firstOrCreate` means running it twice won't duplicate rows.
- **HomeController** fetches the 4 newest products with `Product::with('category')->latest()->take(4)->get()` and sends them to the landing view. `with('category')` loads categories in one query instead of one per product.
- **Landing page**: `@foreach($products as $p)` loops over products. `@csrf` adds the security token. The cart count comes from `count(session('cart', []))`.

## Be ready to answer
- *Why `foreignId('category_id')->constrained()`?* It creates a foreign key so a product can't point to a category that doesn't exist.
- *Why is price a decimal?* Floats cause rounding errors with money.
- *What does `cascadeOnDelete` do?* Deleting a parent row deletes its children. For `order_items.product_id` we used `nullOnDelete` so past orders survive a deleted product.
- *Why hash the password?* Plain passwords are never stored.

## Demo
Run `php artisan migrate:fresh --seed` and show phpMyAdmin with the tables filled.
