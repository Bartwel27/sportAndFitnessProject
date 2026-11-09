<div class="row g-3">
@forelse($products as $p)
<div class="col-6 col-md-3"><div class="card h-100">
@if($p->image)<img src="{{ asset('storage/'.$p->image) }}" class="card-img-top" style="height:160px;object-fit:cover" alt="{{ $p->name }}">@endif
<div class="card-body d-flex flex-column">
<h5>{{ $p->name }}</h5><small class="text-muted">{{ $p->category->name }}</small>
@if($p->stock < 1)<small class="text-danger">Out of stock</small>@elseif($p->stock <= 5)<small class="text-warning">Only {{ $p->stock }} left</small>@endif
<div class="fw-bold mt-auto">K{{ number_format($p->price,2) }}</div>
<a href="/products/{{ $p->id }}" class="btn btn-outline-dark btn-sm mt-2">View</a>
<form method="POST" action="/cart/add/{{ $p->id }}">@csrf<button class="btn btn-dark btn-sm w-100 mt-2" @disabled($p->stock < 1)>Add to cart</button></form>
</div></div></div>
@empty<p>No products found.</p>@endforelse
</div>
<div class="mt-4">{{ $products->links() }}</div>
