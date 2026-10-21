# Joshua: Admin layout, overview dashboard, products, admin middleware

**Your files:** `layouts/admin.blade.php`, `admin/dashboard.blade.php`, `admin/products.blade.php`, `admin/product-edit.blade.php`, `AdminMiddleware.php`, product methods in `AdminController.php`

## How it works
- **AdminMiddleware** runs before every `/admin` route. It checks `$request->user()->role !== 'admin'` and calls `abort(403)` otherwise. It is registered in `bootstrap/app.php` with the alias `admin`, and used in `routes/web.php` as `Route::middleware(['auth','admin'])->prefix('admin')`.
- **Overview:** `dashboard()` counts products, orders, customers and sums revenue (`Order::sum('total')`) and loads the 5 latest orders with their users.
- **Add product:** `storeProduct()` validates (required name, category must exist, price >= 0, stock integer, image must be an image under 2 MB). If a file was uploaded, `store('products','public')` saves it in `storage/app/public/products` and returns the path saved in the `image` column. The form needs `enctype="multipart/form-data"` or files are not sent.
- **Edit:** `editProduct()` shows the form filled with current values; `updateProduct()` validates again, deletes the old image if a new one is uploaded, then `update()`. The form uses `@method('PUT')`.
- **Delete:** removes the image file too, then the row.

## Be ready to answer
- *What is middleware?* A checkpoint every request passes before reaching the controller.
- *Why validate on the server when the HTML has `required`?* Browser checks can be bypassed.
- *Why 403 and not 404?* 403 means "you are known but not allowed".
- *Why delete the old image file?* To avoid filling the disk with unused files.

## Demo
Log in as admin, add a product with a photo, edit its price, delete it. Then log in as a customer and show `/admin` gives 403.
