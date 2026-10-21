<!DOCTYPE html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('title','Bartwel Sports & Fitness')</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body class="bg-light">
<nav class="navbar navbar-expand navbar-dark" style="background:#14181f"><div class="container">
<a class="navbar-brand fw-bold" href="/">BARTWEL<span style="color:#f2c230">.</span>SPORTS</a>
<div class="navbar-nav ms-auto">
<a class="nav-link" href="/products">Shop</a>
@auth<a class="nav-link" href="/dashboard">My account</a>
<form method="POST" action="/logout">@csrf<button class="btn btn-link nav-link">Logout</button></form>
@else<a class="nav-link" href="/login">Login</a>@endauth
<a class="btn btn-warning ms-2" href="/cart">Cart</a></div></div></nav>
<main class="container py-4">@if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif @yield('content')</main>
</body></html>
