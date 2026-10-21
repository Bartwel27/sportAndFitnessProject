# Blessings: Admin orders, users, categories, testing, report, slides

**Your files:** `admin/orders.blade.php`, `admin/users.blade.php`, `admin/categories.blade.php`, order/user/category methods in `AdminController.php`, `docs/TESTING.md`, `docs/REPORT.md`, `docs/PRESENTATION.md`

## How it works
- **Orders:** `orders()` loads orders with their customers (`Order::with('user')`) and paginates 10 per page. Each row has a status dropdown. `updateOrder()` validates the status is one of pending, paid, shipped, delivered (`in:` rule), updates it, and the customer sees it on their dashboard.
- **Users:** `users()` uses `User::withCount('orders')`, which adds an `orders_count` column to each user without extra queries. It needs the `orders()` relationship in `User.php`.
- **Categories:** `storeCategory()` validates the name is unique and creates the slug with `Str::slug('Swimming Gear')` which gives `swimming-gear`. The slug is used in URLs such as `/products?category=gym`. `deleteCategory()` refuses if `$category->products()->exists()`, to avoid deleting products by accident.
- **Testing:** run the 20 tests in `TESTING.md` after everyone merges, mark Pass/Fail, and report bugs to the owner of that part. Then write the results summary in section 7 of the report.

## Be ready to answer
- *What does `withCount` do?* Counts related rows in the same query.
- *Why a slug?* Clean, readable URLs and reliable matching.
- *What kinds of testing did you do?* Manual functional testing: normal use, wrong input, and access control (customer vs admin).
- *Limitations?* No online payment, email or search; say them yourself before being asked.

## Demo
Change an order to shipped and show it on the customer's dashboard; add a category; show the users list.
