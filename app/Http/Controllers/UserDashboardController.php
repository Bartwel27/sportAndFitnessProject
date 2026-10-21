<?php
namespace App\Http\Controllers;
use App\Models\Order;
class UserDashboardController extends Controller {
   public function index()
	{
		if (auth()->user()->role === 'admin') {
			return redirect('/admin');
		}
		$orders = Order::where('user_id', auth()->id())->latest()->get();
		return view('user.dashboard', compact('orders'));
	}
}
