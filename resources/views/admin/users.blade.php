@extends('layouts.admin')
@section('content')
<h2>Users</h2>
<table class="table bg-white"><thead><tr><th>Name</th><th>Email</th><th>Role</th><th>Orders</th><th>Joined</th></tr></thead><tbody>
@foreach($users as $u)<tr><td>{{ $u->name }}</td><td>{{ $u->email }}</td><td><span class="badge bg-{{ $u->role=='admin'?'dark':'secondary' }}">{{ $u->role }}</span></td><td>{{ $u->orders_count }}</td><td>{{ $u->created_at->format('d M Y') }}</td></tr>@endforeach</tbody></table>
{{ $users->links() }}
@endsection
