@extends('layouts.admin')
@section('content')
<h2>Products</h2>
<form method="POST" action="/admin/products" enctype="multipart/form-data" class="row g-2 mb-4 bg-white p-3 rounded">@csrf
<div class="col-md-3"><input name="name" class="form-control" placeholder="Name" required></div>
<div class="col-md-2"><select name="category_id" class="form-select">@foreach($categories as $c)<option value="{{ $c->id }}">{{ $c->name }}</option>@endforeach</select></div>
<div class="col-md-2"><input name="price" type="number" step="0.01" class="form-control" placeholder="Price" required></div>
<div class="col-md-2"><input name="stock" type="number" class="form-control" placeholder="Stock" required></div>
<div class="col-md-3"><input name="image" type="file" accept="image/*" class="form-control"></div>
<div class="col-md-9"><textarea name="description" class="form-control" placeholder="Description"></textarea></div>
<div class="col-md-3"><button class="btn btn-dark w-100">Add product</button></div>
@if($errors->any())<div class="col-12 text-danger">{{ $errors->first() }}</div>@endif</form>
<table class="table bg-white align-middle"><thead><tr><th></th><th>Name</th><th>Category</th><th>Price</th><th>Stock</th><th></th></tr></thead><tbody>
@foreach($products as $p)<tr>
<td>@if($p->image)<img src="{{ asset('storage/'.$p->image) }}" alt="" style="width:50px;height:50px;object-fit:cover">@endif</td>
<td>{{ $p->name }}</td><td>{{ $p->category->name }}</td><td>K{{ number_format($p->price,2) }}</td><td>{{ $p->stock }}</td>
<td class="d-flex gap-1"><a href="/admin/products/{{ $p->id }}/edit" class="btn btn-sm btn-outline-dark">Edit</a>
<form method="POST" action="/admin/products/{{ $p->id }}" onsubmit="return confirm('Delete this product?')">@csrf @method('DELETE')<button class="btn btn-sm btn-danger">Delete</button></form></td></tr>@endforeach</tbody></table>
@endsection
