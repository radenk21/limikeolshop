<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $total_user = User::where('role_as', '0')->count();
        $total_order = Order::count();
        $orders = Order::limit(5);
        $total_pendapatan = number_format(
            OrderItem::whereHas('order', function ($query) {
                $query->where('status_message', 'selesai');
            })->sum('harga'),
            0,
            '.',
            '.'
        );
        $total_pendapatan_per_bulan = OrderItem::whereHas('order', function ($query) {
            $query->where('status_message', 'selesai')
                ->whereYear('created_at', now()->year)
                ->whereMonth('created_at', now()->month);
        })->sum('harga');


        $pendapatan_bulan_lalu = OrderItem::whereHas('order', function ($query) {
            $query->where('status_message', 'selesai')
                ->whereYear('created_at', now()->subMonth()->year)
                ->whereMonth('created_at', now()->subMonth()->month);
        })->sum('harga');

        // $pendapatan_bulan_lalu = 2500000;
        // Menghitung persentase perubahan
        $total_perubahan = ($total_pendapatan_per_bulan - $pendapatan_bulan_lalu);
        // dd($total_pendapatan_per_bulan, $pendapatan_bulan_lalu);
        if ($pendapatan_bulan_lalu != 0) {
            $persentase_perubahan = number_format(($total_pendapatan_per_bulan - $pendapatan_bulan_lalu) / $pendapatan_bulan_lalu * 100, '2');
            // $persentase_perubahan = -1;
        } else {
            $persentase_perubahan = 0;
        }
        

        $total_pendapatan_per_tahun = OrderItem::whereHas('order', function ($query) {
            $query->where('status_message', 'selesai')
                ->whereYear('created_at', now()->year);
        })->sum('harga');

        $total_pendapatan_per_bulan = number_format($total_pendapatan_per_bulan, 0, '.', '.');
        $total_perubahan = number_format($total_perubahan, 0, '.', '.');

        $total_pendapatan_per_tahun = number_format($total_pendapatan_per_tahun, 0, '.', '.');
        
        // dd($total_pendapatan_per_bulan);
        
        return view('admin.dashboard', compact(
            'total_user', 
            'total_order',
            'orders',
            'total_pendapatan_per_bulan',
            'total_pendapatan_per_tahun',
            'total_pendapatan',
            'persentase_perubahan',
            'total_perubahan',
        ));
    }
}
