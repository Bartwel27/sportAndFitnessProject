<!DOCTYPE html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin | Bartwel Sports</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body><div class="d-flex" style="min-height:100vh">
<aside class="p-3 text-white" style="width:220px;background:#14181f">
<h5 class="mb-4">Admin</h5>
<ul class="nav flex-column">
<li><a class="nav-link text-white" href="/admin">Overview</a></li>
<li><a class="nav-link text-white" href="/admin/products">Products</a></li>
<li><a class="nav-link text-white" href="/admin/categories">Categories</a></li>
<li><a class="nav-link text-white" href="/admin/orders">Orders</a></li>
<li><a class="nav-link text-white" href="/admin/users">Users</a></li>
<li><a class="nav-link text-white" href="/">View store</a></li></ul>
<form method="POST" action="/logout" class="mt-4">@csrf
<button class="btn btn-outline-light btn-sm">Logout</button></form>
</aside>
<main class="flex-grow-1 p-4 bg-light">@if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif @yield('content')</main>
</div></body></html>
