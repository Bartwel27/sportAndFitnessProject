# Mapesho: Authentication and user dashboard

**Your files:** Breeze (login, register, logout), `UserDashboardController.php`, `user/dashboard.blade.php`, `layouts/shop.blade.php`

## How it works
- **Laravel Breeze** generated the login, register and logout code: controllers in `app/Http/Controllers/Auth`, routes in `routes/auth.php`. Passwords are hashed with bcrypt and never stored as plain text.
- The `users` table has a `role` column (default `customer`). New registrations become customers; the admin is created by the seeder.
- The **`auth` middleware** protects pages that need login: checkout, dashboard, profile. A guest who opens them is redirected to `/login`.
- `UserDashboardController@index` loads only this user's orders: `Order::where('user_id', auth()->id())->latest()->get()`. `auth()->id()` is the logged-in user's id, so nobody can see another person's orders.
- The view calculates the cards from the collection: `$orders->count()`, `$orders->where('status','pending')->count()`, `$orders->sum('total')`.
- `layouts/shop.blade.php` is the shared layout. `@auth ... @else ... @endauth` shows "My account" and Logout when logged in, or Login when not. `@yield('content')` is where each page's content goes, and pages use `@extends('layouts.shop')`.

## Be ready to answer
- *Authentication vs authorization?* Authentication proves who you are (login). Authorization decides what you may do (customer vs admin).
- *What is CSRF?* A forged-form attack; `@csrf` adds a secret token each form must send.
- *Where do sessions and logins live?* In the `sessions` table in MySQL (that's why the DB must be running).

## Demo
Register, log in, show the dashboard, log out, try `/dashboard` and show the redirect to login.
