@extends('layouts.admin')
@section('content')
<h2>Products</h2>
<div id="admin-msg"></div>
<form id="product-form" data-live method="POST" action="/admin/products" enctype="multipart/form-data" class="row g-2 mb-4 bg-white p-3 rounded">@csrf
<div class="col-md-3"><input name="name" class="form-control" placeholder="Name" required></div>
<div class="col-md-2"><select name="category_id" class="form-select">@foreach($categories as $c)<option value="{{ $c->id }}">{{ $c->name }}</option>@endforeach</select></div>
<div class="col-md-2"><input name="price" type="number" step="0.01" class="form-control" placeholder="Price" required></div>
<div class="col-md-2"><input name="stock" type="number" class="form-control" placeholder="Stock" required></div>
<div class="col-md-3"><input name="image" type="file" accept="image/*" class="form-control"></div>
<div class="col-md-9"><textarea name="description" class="form-control" placeholder="Description"></textarea></div>
<div class="col-md-3"><button class="btn btn-dark w-100">Add product</button></div>
<div id="form-errors" class="col-12 text-danger">@if($errors->any()){{ $errors->first() }}@endif</div></form>
<div id="admin-table">
<table class="table bg-white align-middle"><thead><tr><th></th><th>Name</th><th>Category</th><th>Price</th><th>Stock</th><th></th></tr></thead><tbody>
@foreach($products as $p)<tr>
<td>@if($p->image)<img src="{{ asset('storage/'.$p->image) }}" alt="" style="width:50px;height:50px;object-fit:cover">@endif</td>
<td>{{ $p->name }}</td><td>{{ $p->category->name }}</td><td>K{{ number_format($p->price,2) }}</td><td>{{ $p->stock }}</td>
<td class="d-flex gap-1"><a href="/admin/products/{{ $p->id }}/edit" class="btn btn-sm btn-outline-dark">Edit</a>
<form data-live method="POST" action="/admin/products/{{ $p->id }}" onsubmit="return confirm('Delete this product?')">@csrf @method('DELETE')<button class="btn btn-sm btn-danger">Delete</button></form></td></tr>@endforeach</tbody></table>
</div>
<script>
// Submit add/delete without leaving the page, then refresh only the table.
document.addEventListener('submit', async function (e) {
  var form = e.target;
  if (e.defaultPrevented || !form.hasAttribute('data-live')) { return; }
  e.preventDefault();
  var btn = form.querySelector('button[type=submit], button:not([type])');
  if (btn) { btn.disabled = true; }
  try {
    var res = await fetch(form.action, { method: 'POST', body: new FormData(form), headers: { 'X-Requested-With': 'XMLHttpRequest' } });
    var doc = new DOMParser().parseFromString(await res.text(), 'text/html');
    var err = doc.querySelector('#form-errors');
    var box = document.getElementById('form-errors');
    if (err && err.textContent.trim() !== '') { box.textContent = err.textContent.trim(); return; }
    box.textContent = '';
    document.getElementById('admin-table').innerHTML = doc.getElementById('admin-table').innerHTML;
    var flash = doc.querySelector('.alert-success');
    document.getElementById('admin-msg').innerHTML = flash ? '<div class="alert alert-success">' + flash.textContent + '</div>' : '';
    if (form.id === 'product-form') { form.reset(); }
  } catch (x) {
    document.getElementById('form-errors').textContent = 'Something went wrong. Check the file size and try again.';
  } finally { if (btn) { btn.disabled = false; } }
});
</script>
@endsection
