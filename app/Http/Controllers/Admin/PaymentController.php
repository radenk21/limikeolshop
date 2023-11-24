<?php

namespace App\Http\Controllers\Admin;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $payments = Payment::
        when($request->awalDate != null && $request->akhirDate != null, function($q) use ($request) {
            return $q->whereBetween('created_at', [$request->awalDate, $request->akhirDate]);
        })
        ->when($request->status != null, function($q) use ($request) {
            return $q->where('payment_status', $request->status);
        })
        ->orderBy('created_at', 'desc')->paginate(10);
        $offset = request()->get('page', 1) * $payments->perPage() - $payments->perPage();

        return view('admin.payment.index', compact('payments', 'offset'));
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
        $payment = Payment::findOrFail($id);
        
        return view('admin.payment.show', compact('payment'));
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
        $payment = Payment::findOrFail($id);
        if ($payment) {
            $payment->update([
                'payment_status' => $request->payment_status,
            ]);
            if ($request->status_message == 'ditolak') {
                try {
                    // Menggunakan DB::statement karena stored procedure tidak mengembalikan hasil langsung
                    DB::statement('CALL cancel_order(?)', array($id));
            
                    return redirect()->back()->with('message', 'Pembayaran telah di tolak.');
                } catch (\Exception $e) {
                    // Tampilkan pesan error atau lakukan sesuatu yang sesuai dengan kebutuhan Anda
                    DB::rollBack();
                    return redirect()->back()->with('danger-alert', 'Gagal membatalkan pembayaran: ' . $e->getMessage());
                }
            }
            return back()->with('message', 'Status Pembayaran Telah di Update');
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
}
