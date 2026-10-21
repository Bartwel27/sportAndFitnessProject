@extends('layouts.shop')
@section('title','Checkout')
@section('content')
<h2>Checkout</h2>
<div class="row"><div class="col-md-7">
<form method="POST" action="/checkout" class="card card-body">@csrf
<label class="form-label">Delivery address</label><textarea name="address" class="form-control mb-3" required>{{ old('address') }}</textarea>
<label class="form-label">Phone number</label><input name="phone" class="form-control mb-3" required value="{{ old('phone') }}">
<label class="form-label">Payment method</label>
<select name="payment" class="form-select mb-3"><option value="mobile_money">Mobile money</option><option value="cod">Cash on delivery</option></select>
<button class="btn btn-warning">Place order</button></form></div>
<div class="col-md-5"><div class="card card-body"><h5>Order summary</h5>
@foreach($items as $i)<div class="d-flex justify-content-between"><span>{{ $i['name'] }} x{{ $i['quantity'] }}</span><span>K{{ number_format($i['price']*$i['quantity'],2) }}</span></div>@endforeach
<hr><strong>Total: K{{ number_format($total,2) }}</strong></div></div></div>
@endsection
