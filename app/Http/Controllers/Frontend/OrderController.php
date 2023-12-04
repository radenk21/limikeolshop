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
        $offset = request()->get('page', 1) * $orders->perPage() - $orders->perPage();
        
        return view('frontend.orders.index', compact('orders', 'offset'));
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

    public function batal($order_id)
    {
        // dd('berhasil');
        $user_order = Order::where('id_user', Auth::user()->id)->where('id', $order_id)->update([
            'status_message' => 'batal',
        ]);
        if ($user_order) {
            return redirect()->back()->with('message', 'Berhasil Membatalkan Pesan.');
        } else {
            return redirect()->back()->with('danger-alert', 'Gagal Membatalkan Pesan.');
        }        
    }
}
