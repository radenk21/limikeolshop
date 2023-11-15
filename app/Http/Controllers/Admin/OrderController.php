<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $orders = Order::when($request->date != null, function($q) use ($request) {
                            return $q->whereDate('created_at', $request->date);
                        })->
                        when($request->status != null, function($q) use ($request) {
                            return $q->where('status_message', $request->status);
                        })
                        ->orderBy('created_at', 'desc')->paginate(10);

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
        // dd($order);
        return view('admin.pesanan.show', compact('order'));
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
