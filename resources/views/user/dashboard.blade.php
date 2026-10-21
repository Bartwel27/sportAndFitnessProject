@extends('layouts.shop')
@section('title','My account')
@section('content')
<h2>Welcome, {{ auth()->user()->name }}</h2>
<div class="row g-3 my-2">
<div class="col-md-4"><div class="card card-body"><small>Total orders</small><h3>{{ $orders->count() }}</h3></div></div>
<div class="col-md-4"><div class="card card-body"><small>Pending</small><h3>{{ $orders->where('status','pending')->count() }}</h3></div></div>
<div class="col-md-4"><div class="card card-body"><small>Total spent</small><h3>K{{ number_format($orders->sum('total'),2) }}</h3></div></div></div>
<h4 class="mt-4">Order history</h4>
<table class="table bg-white"><thead><tr><th>Order</th><th>Date</th><th>Total</th><th>Status</th></tr></thead><tbody>
@forelse($orders as $o)<tr><td>#{{ $o->id }}</td><td>{{ $o->created_at->format('d M Y') }}</td><td>K{{ number_format($o->total,2) }}</td><td><span class="badge bg-secondary">{{ ucfirst($o->status) }}</span></td></tr>
@empty<tr><td colspan="4">You have no orders yet.</td></tr>@endforelse</tbody></table>
@endsection
