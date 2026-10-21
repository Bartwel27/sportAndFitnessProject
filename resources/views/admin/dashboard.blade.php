@extends('layouts.admin')
@section('content')
<h2>Overview</h2>

<div class="row g-3 my-2">
  <div class="col-6 col-md-4 col-xl-2"><a href="/admin/products" class="text-decoration-none text-dark"><div class="card card-body"><small>Products</small><h3>{{ $stats['products'] }}</h3></div></a></div>
  <div class="col-6 col-md-4 col-xl-2"><a href="/admin/categories" class="text-decoration-none text-dark"><div class="card card-body"><small>Categories</small><h3>{{ $stats['categories'] }}</h3></div></a></div>
  <div class="col-6 col-md-4 col-xl-2"><a href="/admin/orders" class="text-decoration-none text-dark"><div class="card card-body"><small>Orders</small><h3>{{ $stats['orders'] }}</h3></div></a></div>
  <div class="col-6 col-md-4 col-xl-2"><a href="/admin/orders" class="text-decoration-none text-dark"><div class="card card-body border-warning"><small>Pending approval</small><h3>{{ $stats['pending'] }}</h3></div></a></div>
  <div class="col-6 col-md-4 col-xl-2"><a href="/admin/users" class="text-decoration-none text-dark"><div class="card card-body"><small>Customers</small><h3>{{ $stats['users'] }}</h3></div></a></div>
  <div class="col-6 col-md-4 col-xl-2"><div class="card card-body"><small>Revenue</small><h3>K{{ number_format($stats['revenue'], 2) }}</h3></div></div>
</div>

<div class="d-flex justify-content-between align-items-center mt-4">
  <h4>Latest orders</h4><a href="/admin/orders" class="btn btn-sm btn-dark">Manage orders</a>
</div>
<table class="table bg-white"><thead><tr><th>Order</th><th>Customer</th><th>Total</th><th>Status</th><th>Date</th></tr></thead><tbody>
@forelse($latest as $o)
<tr><td>#{{ $o->id }}</td><td>{{ $o->user->name }}</td><td>K{{ number_format($o->total, 2) }}</td><td><span class="badge bg-secondary">{{ ucfirst($o->status) }}</span></td><td>{{ $o->created_at->format('d M Y') }}</td></tr>
@empty
<tr><td colspan="5">No orders yet.</td></tr>
@endforelse
</tbody></table>

<div class="row g-4 mt-1">
  <div class="col-md-6">
    <h4>Low stock (5 or fewer)</h4>
    <table class="table bg-white"><thead><tr><th>Product</th><th>Category</th><th>Stock</th></tr></thead><tbody>
    @forelse($lowStock as $p)
    <tr><td><a href="/admin/products/{{ $p->id }}/edit">{{ $p->name }}</a></td><td>{{ $p->category->name }}</td><td>{{ $p->stock }}</td></tr>
    @empty
    <tr><td colspan="3">All products are well stocked.</td></tr>
    @endforelse
    </tbody></table>
  </div>
  <div class="col-md-6">
    <h4>Newest customers</h4>
    <table class="table bg-white"><thead><tr><th>Name</th><th>Email</th><th>Joined</th></tr></thead><tbody>
    @forelse($newUsers as $u)
    <tr><td>{{ $u->name }}</td><td>{{ $u->email }}</td><td>{{ $u->created_at->format('d M Y') }}</td></tr>
    @empty
    <tr><td colspan="3">No customers yet.</td></tr>
    @endforelse
    </tbody></table>
  </div>
</div>
@endsection