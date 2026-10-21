@extends('layouts.admin')
@section('content')
<h2>Edit product</h2>
<form method="POST" action="/admin/products/{{ $product->id }}" enctype="multipart/form-data" class="row g-3 bg-white p-3 rounded" style="max-width:640px">@csrf @method('PUT')
<div class="col-12"><label class="form-label">Name</label><input name="name" class="form-control" value="{{ old('name',$product->name) }}" required></div>
<div class="col-md-6"><label class="form-label">Category</label><select name="category_id" class="form-select">@foreach($categories as $c)<option value="{{ $c->id }}" @selected($product->category_id==$c->id)>{{ $c->name }}</option>@endforeach</select></div>
<div class="col-md-3"><label class="form-label">Price</label><input name="price" type="number" step="0.01" class="form-control" value="{{ old('price',$product->price) }}" required></div>
<div class="col-md-3"><label class="form-label">Stock</label><input name="stock" type="number" class="form-control" value="{{ old('stock',$product->stock) }}" required></div>
<div class="col-12"><label class="form-label">Description</label><textarea name="description" class="form-control">{{ old('description',$product->description) }}</textarea></div>
<div class="col-12"><label class="form-label">Image (leave empty to keep the current one)</label>
@if($product->image)<div class="mb-2"><img src="{{ asset('storage/'.$product->image) }}" alt="" style="height:80px"></div>@endif
<input name="image" type="file" accept="image/*" class="form-control"></div>
@if($errors->any())<div class="col-12 text-danger">{{ $errors->first() }}</div>@endif
<div class="col-12"><button class="btn btn-dark">Save changes</button> <a href="/admin/products" class="btn btn-link">Cancel</a></div></form>
@endsection
