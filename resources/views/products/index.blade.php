@extends('layouts.shop')
@section('title','Shop')
@section('content')
<h2>Shop</h2>
<form class="row g-2 mb-4" method="GET">
<div class="col-md-4"><select name="category" class="form-select" onchange="this.form.submit()">
<option value="">All categories</option>
@foreach($categories as $c)<option value="{{ $c->slug }}" @selected(request("category")==$c->slug)>{{ $c->name }}</option>@endforeach
</select></div></form>
<div class="row g-3">
@forelse($products as $p)
<div class="col-6 col-md-3"><div class="card h-100">@if($p->image)<img src="{{ asset('storage/'.$p->image) }}" class="card-img-top" style="height:160px;object-fit:cover" alt="{{ $p->name }}">@endif<div class="card-body d-flex flex-column">
<h5>{{ $p->name }}</h5><small class="text-muted">{{ $p->category->name }}</small>
<div class="fw-bold mt-auto">K{{ number_format($p->price,2) }}</div>
<a href="/products/{{ $p->id }}" class="btn btn-outline-dark btn-sm mt-2">View</a>
<form method="POST" action="/cart/add/{{ $p->id }}">@csrf<button class="btn btn-dark btn-sm w-100 mt-2">Add to cart</button></form>
</div></div></div>
@empty<p>No products found in this category.</p>@endforelse
</div>
<div class="mt-4">{{ $products->links() }}</div>
@endsection
