@extends('layouts.shop')
@section('title',$product->name)
@section('content')
<div class="row"><div class="col-md-6">@if($product->image)<img src="{{ asset('storage/'.$product->image) }}" class="img-fluid rounded" alt="{{ $product->name }}">@else<div class="bg-secondary text-white d-grid rounded" style="height:300px;place-items:center">{{ $product->name }}</div>@endif</div>
<div class="col-md-6"><h2>{{ $product->name }}</h2><p class="text-muted">{{ $product->category->name }}</p>
<p>{{ $product->description }}</p><h3>K{{ number_format($product->price,2) }}</h3>
<p>{{ $product->stock > 0 ? $product->stock.' in stock' : 'Out of stock' }}</p>
<form method="POST" action="/cart/add/{{ $product->id }}" class="d-flex gap-2">@csrf
<input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="form-control w-25">
<button class="btn btn-warning" @disabled($product->stock<1)>Add to cart</button></form></div></div>
@endsection
