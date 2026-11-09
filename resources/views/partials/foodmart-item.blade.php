<div class="product-item">
  @if($p->stock < 1)<span class="badge bg-danger position-absolute m-3">Out of stock</span>
  @elseif($p->stock <= 5)<span class="badge bg-success position-absolute m-3">Only {{ $p->stock }} left</span>@endif

  <button type="button" class="btn-wishlist" aria-label="Wishlist">
    <svg width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M20.16 4.61A6.27 6.27 0 0 0 12 4a6.27 6.27 0 0 0-8.16 9.48l7.45 7.45a1 1 0 0 0 1.42 0l7.45-7.45a6.27 6.27 0 0 0 0-8.87Zm-1.41 7.46L12 18.81l-6.75-6.74a4.28 4.28 0 0 1 3-7.3a4.25 4.25 0 0 1 3 1.25a1 1 0 0 0 1.42 0a4.27 4.27 0 0 1 6 6.05Z"/></svg>
  </button>

  <figure>
    <a href="/products/{{ $p->id }}" title="{{ $p->name }}">
      @if($p->image)
        <img src="{{ asset('storage/'.$p->image) }}" alt="{{ $p->name }}" class="tab-image" style="height:210px;object-fit:contain">
      @else
        <div class="d-grid" style="height:210px;place-items:center;font-size:52px;font-weight:700;color:#c9c9c9">{{ strtoupper(substr($p->name, 0, 2)) }}</div>
      @endif
    </a>
  </figure>

  <h3>{{ $p->name }}</h3>
  <span class="qty">{{ $p->category->name }}</span>
  <span class="price">K{{ number_format($p->price, 2) }}</span>

  <form method="POST" action="/cart/add/{{ $p->id }}" class="d-flex align-items-center justify-content-between">@csrf
    <div class="input-group product-qty">
      <span class="input-group-btn"><button type="button" class="quantity-left-minus btn btn-danger btn-number"><svg width="16" height="16"><use xlink:href="#minus"></use></svg></button></span>
      <input type="text" name="quantity" class="form-control input-number" value="1" aria-label="Quantity">
      <span class="input-group-btn"><button type="button" class="quantity-right-plus btn btn-success btn-number" data-max="{{ $p->stock }}"><svg width="16" height="16"><use xlink:href="#plus"></use></svg></button></span>
    </div>
    <button class="nav-link border-0 bg-transparent p-0" @disabled($p->stock < 1)>Add to Cart</button>
  </form>
</div>
