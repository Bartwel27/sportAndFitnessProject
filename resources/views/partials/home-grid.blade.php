@if($products->isEmpty())
  <p>No products yet. Check back soon.</p>
@else
  <div class="product-grid row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5">
    @foreach($products as $p)<div class="col">@include('partials.foodmart-item', ['p' => $p])</div>@endforeach
  </div>
@endif
