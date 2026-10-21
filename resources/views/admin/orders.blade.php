@extends('layouts.admin')
@section('content')
<h2>Orders</h2>
<table class="table bg-white"><thead><tr><th>Order</th><th>Customer</th><th>Address</th><th>Total</th><th>Status</th></tr></thead><tbody>
@foreach($orders as $o)<tr><td>#{{ $o->id }}</td><td>{{ $o->user->name }}<br><small>{{ $o->phone }}</small></td><td>{{ $o->address }}</td><td>K{{ number_format($o->total,2) }}</td>
<td><form method="POST" action="/admin/orders/{{ $o->id }}" class="d-flex gap-1">@csrf @method('PATCH')
<select name="status" class="form-select form-select-sm">@foreach(['pending','paid','shipped','delivered'] as $s)<option @selected($o->status==$s)>{{ $s }}</option>@endforeach</select>
<button class="btn btn-sm btn-dark">Save</button></form></td></tr>@endforeach</tbody></table>
{{ $orders->links() }}
@endsection
