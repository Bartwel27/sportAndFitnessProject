@extends('layouts.admin')
@section('content')
<h2>Categories</h2>
<form method="POST" action="/admin/categories" class="row g-2 mb-4 bg-white p-3 rounded" style="max-width:520px">@csrf
<div class="col-8"><input name="name" class="form-control" placeholder="New category name" required></div>
<div class="col-4"><button class="btn btn-dark w-100">Add</button></div>
@error('name')<div class="col-12 text-danger">{{ $message }}</div>@enderror</form>
<table class="table bg-white" style="max-width:640px"><thead><tr><th>Name</th><th>Slug</th><th>Products</th><th></th></tr></thead><tbody>
@foreach($categories as $c)<tr><td>{{ $c->name }}</td><td>{{ $c->slug }}</td><td>{{ $c->products_count }}</td>
<td><form method="POST" action="/admin/categories/{{ $c->id }}" onsubmit="return confirm('Delete this category?')">@csrf @method('DELETE')<button class="btn btn-sm btn-danger">Delete</button></form></td></tr>@endforeach</tbody></table>
@endsection
