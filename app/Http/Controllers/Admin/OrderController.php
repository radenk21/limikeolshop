<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $orders = Order::
                        when($request->awalDate != null && $request->akhirDate != null, function($q) use ($request) {
                            return $q->whereBetween('created_at', [$request->awalDate, $request->akhirDate]);
                        })->
                        when($request->status != null, function($q) use ($request) {
                            return $q->where('status_message', $request->status);
                        })->
                        when($request->metode_pembayaran != null, function($q) use ($request) {
                            return $q->where('payment_mode', $request->metode_pembayaran);
                        })
                        ->orderBy('created_at', 'desc')->get();
        // $offset = request()->get('page', 1) * $orders->perPage() - $orders->perPage();

        return view('admin.pesanan.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::where('id', $id)->first();
        $payment_status = Payment::where('id_order', $id)->pluck('payment_status')->first();
        if (!$payment_status) {
            $payment_status= 'tidak ada';
        }
        return view('admin.pesanan.show', compact('order', 'payment_status'));
        
        // dd($payment);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $order = Order::where('id', $id)->first();
        if ($order) {
            $order->update([
                'status_message' => $request->status_message,
            ]);
            if ($request->status_message == 'cancelled') {
                try {
                    // Menggunakan DB::statement karena stored procedure tidak mengembalikan hasil langsung
                    DB::statement('CALL cancel_order(?)', array($id));
            
                    return redirect()->back()->with('message', 'Order telah dibatalkan.');
                } catch (\Exception $e) {
                    // Tampilkan pesan error atau lakukan sesuatu yang sesuai dengan kebutuhan Anda
                    DB::rollBack();
                    return redirect()->back()->with('danger-alert', 'Gagal membatalkan order: ' . $e->getMessage());
                }
            }
            return back()->with('message', 'Status Pesan Telah di Update');
        } else {
            return back()->with('danger-alert', 'Terjadi Kesalahan Saat Mengupdate Status');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function invoiceGenerate($id)
    {
        $order = Order::findOrFail($id);
        return view('admin.invoice.generate-invoice', compact('order'));
    }

    public function invoiceDownload($id)
    {
        $order = Order::findOrFail($id);
        $todayDate = Carbon::now()->format('d-m-Y');
        // dd($todayDate);
        $data = ['order' => $order];
        $pdf = Pdf::loadView('admin.invoice.generate-invoice', $data);

        return $pdf->download('invoice'. $order->id . '-'. $todayDate . '.pdf');
    }   

    
}
