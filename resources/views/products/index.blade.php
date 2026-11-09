@extends('layouts.shop')
@section('title','Shop')
@section('content')
<h2>Shop</h2>
<form class="row g-2 mb-4" method="GET">
  <div class="col-md-4"><select name="category" class="form-select" onchange="this.form.submit()">
    <option value="">All categories</option>
    @foreach($categories as $c)<option value="{{ $c->slug }}" @selected(request('category')==$c->slug)>{{ $c->name }}</option>@endforeach
  </select></div>
  <div class="col-md-4"><input type="search" name="q" class="form-control" placeholder="Search products" value="{{ request('q') }}"></div>
  <div class="col-md-2"><button class="btn btn-dark w-100">Search</button></div>
</form>

<div data-live-block="shop">
  @include('partials.shop-grid')
</div>

<script src="{{ asset('js/live.js') }}?v={{ filemtime(public_path('js/live.js')) }}"></script>
@endsection
