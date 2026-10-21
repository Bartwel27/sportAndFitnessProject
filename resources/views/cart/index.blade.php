@extends('layouts.shop')
@section('title','Your cart')
@section('content')
<h2>Your cart</h2>
@if(empty($items))<p>Your cart is empty. <a href="/products">Start shopping</a></p>
@else
<table class="table bg-white"><thead><tr><th>Product</th><th>Price</th><th>Qty</th><th>Subtotal</th><th></th></tr></thead><tbody>
@foreach($items as $id=>$i)
<tr><td>{{ $i['name'] }}</td><td>K{{ number_format($i['price'],2) }}</td>
<td><form method="POST" action="/cart/update/{{ $id }}" class="d-flex gap-1">@csrf @method('PATCH')
<input type="number" name="quantity" value="{{ $i['quantity'] }}" min="1" class="form-control form-control-sm" style="width:70px"><button class="btn btn-sm btn-outline-dark">Update</button></form></td>
<td>K{{ number_format($i['price']*$i['quantity'],2) }}</td>
<td><form method="POST" action="/cart/remove/{{ $id }}">@csrf @method('DELETE')<button class="btn btn-sm btn-danger">Remove</button></form></td></tr>
@endforeach</tbody></table>
<div class="text-end"><h4>Total: K{{ number_format($total,2) }}</h4><a href="/checkout" class="btn btn-warning">Go to checkout</a></div>
@endif
@endsection
