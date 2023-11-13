<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('id_user', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(5);
        
        return view('frontend.orders.index', compact('orders'));
    }

    public function view($order_id)
    {
        $user_order = Order::where('id_user', Auth::user()->id)->where('id', $order_id)->first();
        if ($user_order) {
            return view('frontend.orders.view', compact('user_order'));
        } else {
            return redirect()->back()->with('danger-alert', 'Tidak ada pemesanan yang ditemukan');
        }
        
    }
}
